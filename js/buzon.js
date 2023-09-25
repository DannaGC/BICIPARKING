
const stars = document.querySelectorAll('.star');
const ratingValue = document.getElementById('rating-value');
const commentInput = document.getElementById('comment');
const submitButton = document.getElementById('submit');
const averageRating = document.getElementById('average-rating');
const commentsContainer = document.getElementById('comments');

let rating = 0;
let comments = [];
let totalRating = 0;

stars.forEach((star) => {
  star.addEventListener('mouseover', () => {
    const starValue = parseInt(star.getAttribute('data-rating'));
    highlightStars(starValue);
  });

  star.addEventListener('mouseout', () => {
    highlightStars(rating);
  });

  star.addEventListener('click', () => {
    rating = parseInt(star.getAttribute('data-rating'));
    ratingValue.textContent = rating;
  });
});

submitButton.addEventListener('click', (e) => {
  e.preventDefault();
  const comment = commentInput.value.trim();

  if (rating === 0) {
    alert('Por favor, selecciona una calificación antes de enviar tu comentario.');
    return;
  }

  comments.push({ rating, comment });
  totalRating += rating;

  const average = totalRating / comments.length;
  averageRating.textContent = average.toFixed(1);

  displayComments();

  rating = 0;
  ratingValue.textContent = '0';
  commentInput.value = '';
});

function highlightStars(starValue) {
  stars.forEach((star, index) => {
    if (index < starValue) {
      star.style.color = '#f1c40f';
    } else {
      star.style.color = '#ddd';
    }
  });
}

function displayComments() {
  commentsContainer.innerHTML = '<h4 class="comments-text">Comentarios:</h4>';

  comments.forEach((commentObj) => {
    const commentElement = document.createElement('div');
    commentElement.innerHTML = `<h4><strong>Calificación:</strong> ${commentObj.rating} estrellas</h4><p>${commentObj.comment}</p>`;
    commentsContainer.appendChild(commentElement);
  });
}