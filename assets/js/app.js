/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

 var $ = require('jquery');

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

require('select2');

$('select').select2();
var contactButton = $('#contactButton');
contactButton.click(function(e){
  e.preventDefault();
  $('#contactForm').slideDown();
  contactButton.slideUp();
});


//Suppression des éléments pictures
document.querySelectorAll('[data-delete]').forEach(a => {
  a.addEventListener('click', e => {
    e.preventDefault();
    fetch(a.getAttribute('href'), {
      method: 'DELETE',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type'    : 'application/json'
      },
      body: JSON.stringify({'_token': a.dataset.token})
    }).then(reponse => reponse.json())
      .then(data => {
        if (data.success) {
          a.parentNode.parentNode.removeChild(a.parentNode);
        } else {
          alert(data.error);
        }
      })
      .catch(e => alert(e))
  });
  
});
