export function initCarousel() {
  // Когда страница полностью загружена
  window.addEventListener('load', function () {
    // Получаем кнопки "Предыдущий" и "Следующий"
    let btnPrev = document.querySelector('.prev-button');
    let btnNext = document.querySelector('.next-button');

    // Получаем контейнер карусели и все слайды
    let carousel = document.querySelector('.carousel');
    let slides = document.querySelectorAll('.carousel .slide');

    // Общее количество слайдов
    let totalSlides = slides.length;

    // Ширина одного слайда
    let slideWidth = 200;

    // Текущий индекс слайда
    let currentIndex = 0;

    // Флаг для проверки состояния перехода
    let transitionInProgress = false;

    // Массив путей к изображениям
    let images = [
      'img/cl1.png',
      'img/cl2.png',
      'img/cl3.png',
      'img/avantel.jpg',
      'img/nik.jpg',
      'img/wp2812978.png',
      'img/samolet-LO.jpeg',
      'img/cds.jpg',
      'img/Brusnika.jpg'
    ];

    // Устанавливаем общее количество слайдов
    totalSlides = images.length;

    // Генерация слайдов из массива изображений
    images.forEach((imageSrc) => {
      let slide = document.createElement('img');
      slide.classList.add('slide');
      slide.src = imageSrc;
      carousel.appendChild(slide);
    });

    // Устанавливаем начальное смещение для карусели
    carousel.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

    // Функция для перехода к следующему слайду с плавной анимацией
    function nextSlide() {
      if (transitionInProgress) return; // Прервать, если переход уже идет

      // Вычисляем новый индекс слайда
      const newIndex = (currentIndex + 1) % totalSlides;

      if (newIndex === 0) {
        // Если новый индекс равен 0, перемещаем карусель без анимации на последний слайд
        carousel.style.transition = 'none';
        carousel.style.transform = `translateX(-${totalSlides * slideWidth}px)`;

        // Небольшая пауза для применения стилей
        setTimeout(() => {
          // Возвращаем анимацию и перемещаем карусель на первый слайд
          carousel.style.transition = 'transform 0.4s ease-in-out';
          carousel.style.transform = `translateX(-${newIndex * slideWidth}px)`;
          currentIndex = newIndex; // Обновляем текущий индекс
        }, 10);
      } else {
        currentIndex = newIndex;
        updateCarousel();
      }
    }

    // Функция для перехода к предыдущему слайду с плавной анимацией
    function prevSlide() {
      if (transitionInProgress) return; // Прервать, если переход уже идет

      // Вычисляем новый индекс слайда
      const newIndex = (currentIndex - 1 + totalSlides) % totalSlides;

      if (currentIndex === 0) {
        // Если текущий индекс равен 0, перемещаем карусель без анимации на первый слайд
        carousel.style.transition = 'none';
        carousel.style.transform = 'translateX(0)';

        // Небольшая пауза для применения стилей
        setTimeout(() => {
          // Возвращаем анимацию и перемещаем карусель на последний слайд
          carousel.style.transition = 'transform 0.4s ease-in-out';
          carousel.style.transform = `translateX(-${newIndex * slideWidth}px)`;
          currentIndex = newIndex; // Обновляем текущий индекс
        }, 10);
      } else {
        currentIndex = newIndex;
        updateCarousel();
      }
    }

    // Запускаем плавную смену слайдов каждые 3 секунды
    setInterval(nextSlide, 5000);

    // Привязываем функции к кликам на кнопки "Предыдущий" и "Следующий"
    btnPrev.addEventListener('click', prevSlide);
    btnNext.addEventListener('click', nextSlide);

    // Обновление карусели с плавной анимацией
    function updateCarousel() {
      transitionInProgress = true; // Устанавливаем флаг перехода
      let offset = -currentIndex * slideWidth;

      carousel.style.transition = 'transform 0.4s ease-in-out';
      carousel.style.transform = `translateX(${offset}px)`;

      // Очищаем флаг перехода после завершения анимации
      setTimeout(() => {
        transitionInProgress = false;
      }, 400);
    }
  });
}
