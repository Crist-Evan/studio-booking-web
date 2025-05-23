// Ambil elemen
const bookingDateInput = document.getElementById("booking_date");
const startTimeInput = document.getElementById("start_time");
const endTimeInput = document.getElementById("end_time");
const studioSelect = document.getElementById("studio_id");
const totalText = document.getElementById("totalText");

// Fungsi untuk mendapatkan jam yang sudah dibooking
async function fetchBookedTimes(date, studioId) {
  const res = await fetch(`getBookedSlots.php?date=${date}&studio=${studioId}`);
  const bookedSlots = await res.json();
  return bookedSlots; // Format: [{start_time: "13:00", end_time: "15:00"}, ...]
}

// Fungsi untuk mengecek apakah jam tertentu ada di rentang waktu booking
function isTimeBooked(time, bookedSlots) {
  return bookedSlots.some((slot) => {
    const slotStart = slot.start_time.slice(0, 5);
    const slotEnd = slot.end_time.slice(0, 5);
    return time >= slotStart && time < slotEnd;
  });
}

// Fungsi untuk generate opsi jam mulai
function generateStartOptions(minHour, bookedSlots) {
  startTimeInput.innerHTML = "";
  for (let hour = minHour; hour <= 21; hour++) {
    const time = `${hour.toString().padStart(2, "0")}:00`;
    if (!isTimeBooked(time, bookedSlots)) {
      const option = document.createElement("option");
      option.value = time;
      option.textContent = time;
      startTimeInput.appendChild(option);
    }
  }
  generateEndOptions(); // Update end options setelah start options di-generate
}

// Fungsi untuk generate opsi jam selesai
function generateEndOptions() {
  const startTime = startTimeInput.value;
  const [startHour] = startTime.split(":");
  endTimeInput.innerHTML = "";
  for (let hour = parseInt(startHour) + 1; hour <= 22; hour++) {
    const time = `${hour.toString().padStart(2, "0")}:00`;
    const option = document.createElement("option");
    option.value = time;
    option.textContent = time;
    endTimeInput.appendChild(option);
  }
  updateTotal();
}

// Fungsi untuk update total harga
function updateTotal() {
  const startTime = startTimeInput.value;
  const endTime = endTimeInput.value;
  const studioOption = studioSelect.options[studioSelect.selectedIndex];
  const pricePerHour = parseInt(studioOption.dataset.price);

  if (!startTime || !endTime || isNaN(pricePerHour)) {
    totalText.textContent = "Total: Rp0";
    return;
  }

  const startHour = parseInt(startTime.split(":")[0]);
  const endHour = parseInt(endTime.split(":")[0]);
  const duration = endHour - startHour;

  if (duration > 0) {
    const total = duration * pricePerHour;
    totalText.textContent = `Total: Rp${total.toLocaleString("id-ID")}`;
  } else {
    totalText.textContent = "Total: Rp0";
  }
}

// Event listener saat tanggal berubah
bookingDateInput.addEventListener("change", async function () {
  const selectedDate = this.value;
  const selectedStudio = studioSelect.value;

  if (!selectedDate || !selectedStudio) return;

  const today = new Date().toISOString().split("T")[0];
  const bookedSlots = await fetchBookedTimes(selectedDate, selectedStudio);

  if (selectedDate === today) {
    const currentHour = new Date().getHours();
    generateStartOptions(currentHour + 1, bookedSlots);
  } else {
    generateStartOptions(8, bookedSlots);
  }
});

// Event listener saat studio berubah
bookingDateInput.addEventListener("change", async function () {
  const selectedDate = this.value;
  const selectedStudio = studioSelect.value;

  const today = new Date().toISOString().split("T")[0];
  const bookedSlots = await fetchBookedTimes(selectedDate, selectedStudio);

  if (selectedDate === today) {
    const currentHour = new Date().getHours();
    generateStartOptions(currentHour + 1, bookedSlots);
  } else {
    generateStartOptions(8, bookedSlots);
  }
});

// Event listener untuk update jam selesai dan total saat jam mulai dipilih
startTimeInput.addEventListener("change", function () {
  generateEndOptions();
  updateTotal();
});

// Update total harga ketika elemen berubah
studioSelect.addEventListener("change", updateTotal);
endTimeInput.addEventListener("change", updateTotal);
