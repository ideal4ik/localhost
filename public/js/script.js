/* script.js */
// Открытие и закрытие всплывающего окна
document.getElementById('openButton').addEventListener('click', function() {
    document.getElementById('popupContainer').style.display = 'block';
});

document.getElementById('closeButton').addEventListener('click', function() {
    document.getElementById('popupContainer').style.display = 'none';
});

document.addEventListener('click', function(event) {
    var popup = document.getElementById('popupContainer');
    var openButton = document.getElementById('openButton');
    
    // Если клик был совершен не по всплывающему окну и не по кнопке открытия,
    // то скрываем окно
    if (event.target !== popup && event.target !== openButton && event.target !== popupContent) {
        popup.style.display = 'none';
    }
});