$(function() {
    $('[data-toggle="tooltip"]').tooltip()
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const amount = urlParams.get('price')
    if (amount) {
        $('#price').val(amount)
    }
    
	/*
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          event.preventDefault();  
          event.stopPropagation();
          console.log('hello')
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }else{
            
			sendData();
			
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
	*/
	
	
	
	
	

    
    });
	


	
	

	