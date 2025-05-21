const startTimeSelect = document.getElementById("start_time");
const endTimeSelect = document.getElementById("end_time");
const bookingDateInput = document.getElementById("booking_date");

function generateStartOptions(minHour) {
  startTimeSelect.innerHTML = "";
  for (let i = minHour; i <= 21; i++) {
    let jam = (i < 10 ? "0" + i : i) + ":00";
    let option = document.createElement("option");
    option.value = jam;
    option.textContent = jam;
    startTimeSelect.appendChild(option);
  }
}

function generateEndOptions(startHour) {
  endTimeSelect.innerHTML = "";
  for (let i = startHour + 1; i <= 22; i++) {
    let jam = (i < 10 ? "0" + i : i) + ":00";
    let option = document.createElement("option");
    option.value = jam;
    option.textContent = jam;
    endTimeSelect.appendChild(option);
  }
}

// Ubah jam mulai berdasarkan tanggal
bookingDateInput.addEventListener("change", function () {
  const selectedDate = new Date(this.value);
  const today = new Date();
  const isToday = selectedDate.toDateString() === today.toDateString();

  if (isToday) {
    let currentHour = today.getHours() + 1;

    if (currentHour > 21) {
      // Sudah terlalu malam, tidak ada jam tersedia
      startTimeSelect.innerHTML = "";
      let option = document.createElement("option");
      option.textContent = "Tidak tersedia";
      option.disabled = true;
      option.selected = true;
      startTimeSelect.appendChild(option);

      endTimeSelect.innerHTML = "";
      let endOption = document.createElement("option");
      endOption.textContent = "Tidak tersedia";
      endOption.disabled = true;
      endTimeSelect.appendChild(endOption);
      return;
    }
    generateStartOptions(currentHour);
  } else {
    generateStartOptions(8);
  }

  // Trigger isi jam selesai pertama kali
  if (startTimeSelect.options.length > 0) {
    startTimeSelect.selectedIndex = 0;
    const selectedHour = parseInt(startTimeSelect.value.split(":")[0]);
    generateEndOptions(selectedHour);
  }
});

// Ubah jam selesai saat jam mulai diubah
startTimeSelect.addEventListener("change", function () {
  const selectedHour = parseInt(this.value.split(":")[0]);
  generateEndOptions(selectedHour);
});

// Inisialisasi awal
bookingDateInput.dispatchEvent(new Event("change"));
