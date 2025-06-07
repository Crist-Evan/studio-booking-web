let studioSchedule = {};
let bookedHours = [];
const studioSelect = document.getElementById("studio_id");
const bookingDateInput = document.getElementById("booking_date");
const startTimeSelect = document.getElementById("start_time");
const endTimeSelect = document.getElementById("end_time");
const totalInput = document.getElementById("total"); // untuk tampilkan total
const totalHidden = document.getElementById("total_hidden"); // jika ingin kirim ke backend
const locationInput = document.getElementById("studio_loc");
const descriptionInput = document.getElementById("studio_desc");

const dayMap = [
  "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
];

// Saat studio dipilih
studioSelect.addEventListener("change", async function () {
  const studioId = this.value;
  if (!studioId) return;

  // Reset semua field terkait
  bookingDateInput.value = "";
  startTimeSelect.innerHTML = "";
  endTimeSelect.innerHTML = "";
  totalInput.value = "";
  if (totalHidden) totalHidden.value = "";

  // Ambil lokasi & deskripsi
  const res = await fetch(`getStudioInfo.php?studio_id=${studioId}`);
  const data = await res.json();

  locationInput.value = data.location || "—";
  descriptionInput.value = data.description || "—";

  // Ambil data jadwal studio
  const res2 = await fetch(`getStudioSchedule.php?studio_id=${studioId}`);
  studioSchedule = await res2.json();

  // Dapatkan hari buka dari data
  const allowedDays = Object.keys(studioSchedule).map((day) =>
    dayMap.indexOf(day)
  );

  // Set flatpickr ulang agar sesuai jadwal studio yang baru
  if (window.flatpickrInstance) window.flatpickrInstance.destroy();
  window.flatpickrInstance = flatpickr(bookingDateInput, {
    dateFormat: "Y-m-d",
    minDate: "today",
    disable: [
      function (date) {
        return !allowedDays.includes(date.getDay());
      },
    ],
  });
});

// Saat tanggal dipilih
bookingDateInput.addEventListener("change", async function () {
  const selectedDate = this.value;
  const studioId = studioSelect.value;
  if (!selectedDate || !studioId) return;

  const dayName = dayMap[new Date(selectedDate).getDay()];
  const scheduleToday = studioSchedule[dayName] || [];

  const bookedRes = await fetch(
    `getBookedSlots.php?date=${selectedDate}&studio_id=${studioId}`
  );
  const bookedSlots = await bookedRes.json();

  // Ekstrak semua jam yang sudah dipesan dari setiap slot
  bookedHours = [];

  bookedSlots.forEach((slot) => {
    const start = parseInt(slot.start_time.split(":")[0]);
    const end = parseInt(slot.end_time.split(":")[0]);

    for (let h = start; h < end; h++) {
      bookedHours.push(h);
    }
  });

  // Generate jam mulai
  startTimeSelect.innerHTML = "";
  scheduleToday.forEach((range) => {
    const startHour = parseInt(range.open.split(":")[0]);
    const endHour = parseInt(range.close.split(":")[0]);
    for (let h = startHour; h < endHour; h++) {
      if (!bookedHours.includes(h)) {
        const opt = document.createElement("option");
        opt.value = `${h.toString().padStart(2, "0")}:00`;
        opt.textContent = opt.value;
        startTimeSelect.appendChild(opt);
      }
    }
  });

  endTimeSelect.innerHTML = "";
  totalInput.value = "";
  if (totalHidden) totalHidden.value = "";

  if (startTimeSelect.options.length > 0) {
    startTimeSelect.selectedIndex = 0; // pilih otomatis opsi pertama
    const event = new Event("change"); // picu event change
    startTimeSelect.dispatchEvent(event);
  }
});

// Saat jam mulai dipilih
startTimeSelect.addEventListener("change", function () {
  const startHour = parseInt(this.value.split(":")[0]);
  const selectedDate = bookingDateInput.value;
  const dayName = dayMap[new Date(selectedDate).getDay()];
  const scheduleToday = studioSchedule[dayName] || [];

  endTimeSelect.innerHTML = "";

  // Temukan rentang jadwal yang cocok dengan startHour
  let matchedRange = null;
  for (let range of scheduleToday) {
    const rangeStart = parseInt(range.open.split(":")[0]);
    const rangeEnd = parseInt(range.close.split(":")[0]);

    if (startHour >= rangeStart && startHour < rangeEnd) {
      matchedRange = { start: rangeStart, end: rangeEnd };
      break;
    }
  }

  if (!matchedRange) return;

  // Isi jam akhir hanya dalam rentang yang cocok
  for (let h = startHour + 1; h <= matchedRange.end; h++) {
    // Cek apakah ada konflik di rentang jam start → h
    let conflict = false;
    for (let b = startHour; b < h; b++) {
      if (bookedHours.includes(b)) {
        conflict = true;
        break;
      }
    }

    if (conflict) break;

    const opt = document.createElement("option");
    opt.value = `${h.toString().padStart(2, "0")}:00`;
    opt.textContent = opt.value;
    endTimeSelect.appendChild(opt);
  }

  // Hitung total kalau jam akhir sudah langsung auto-pilih
  if (endTimeSelect.options.length > 0) {
    endTimeSelect.selectedIndex = 0;
    hitungTotal();
  }
});

// Saat jam akhir dipilih
endTimeSelect.addEventListener("change", hitungTotal);

// Fungsi total harga
function hitungTotal() {
  const start = startTimeSelect.value;
  const end = endTimeSelect.value;
  const selectedOption = studioSelect.options[studioSelect.selectedIndex];
  const pricePerHour = parseFloat(selectedOption.getAttribute("data-price"));

  if (start && end && !isNaN(pricePerHour)) {
    const durasi = parseInt(end.split(":")[0]) - parseInt(start.split(":")[0]);
    if (durasi > 0) {
      const total = durasi * pricePerHour;
      totalInput.value = `Rp ${total.toLocaleString("id-ID")}`;
      if (totalHidden) totalHidden.value = total;
    }
  }
}
