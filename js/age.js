     function populateSelect(elementId, start, end) {
      const selectElement = document.getElementById(elementId);
      for (let i = start; i <= end; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.text = i;
        selectElement.appendChild(option);
      }
    }
    populateSelect('ageFrom', 20, 73);
    populateSelect('ageTo', 20, 73);