document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input').forEach(function(input) {
      input.addEventListener('input', function() {
        input.nextElementSibling.textContent = '';
      });
    });
  });