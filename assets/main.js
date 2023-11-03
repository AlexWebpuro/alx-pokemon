function makeAjaxRequest( event ) {

    event.preventDefault();
    event.target.setAttribute('disabled', '');

    const $alert = document.getElementById('pokedex_old_number');
    const param = new URLSearchParams( new FormData( document.getElementById('form') ) );
  
    fetch(pokemon_vars.ajax_url, {
      method: 'POST',
      body: param,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
      })
      .then((data) => {
        $alert.style.display = 'block';
        $alert.innerHTML += data;
      })
      .catch((error) => {
        console.error(error);
      });
  }
  
  // Call the function to make the AJAX request when needed
  document.querySelector('.pokemon__id').addEventListener( 'click', makeAjaxRequest );