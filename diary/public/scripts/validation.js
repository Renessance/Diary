 function validateEmail(em) {
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return expr.test(em);
};
function validateName(n) {
    var nr = /.[a-zA-Z]+$/;
    return nr.test(n);
};

//Actions
$('#name').on("change blur" ,function() {
   var n = $('#name').val();
   if( !validateName(n) || n.length==0 ) {
     $('.pn').css('color','transparent');
     $('.fn').css('color','#c44');
     $('#name').css('border','1px solid red');
   }
   else {
      $('.pn').css('color','#2c2');
      $('.fn').css('color','transparent');
      $('#name').css('border','1px solid transparent');
   }
});

$('#email').on("change blur" ,function() {
   var em = $('#email').val();
   if( !validateEmail(em) || em.length==0 ) {
      $('.pe').css('color','transparent');
     $('.fe').css('color','#c44');
     $('#email').css('border','1px solid red');
   }
   else {
     $('.pe').css('color','#00cc00');
      $('.fe').css('color','transparent');
      $('#email').css('border','1px solid transparent');
   }
});

$('#pass').on("change blur" ,function() {
   var pa = $('#pass').val();
   if( pa.length<=6 || pa.length>=12 ) {
      $('.pp').css('color','transparent');
     $('.fp').css('color','#c44');
     $('#pass').css('border','1px solid red');
   }
   else {
     $('.pp').css('color','#00cc00');
      $('.fp').css('color','transparent');
      $('#pass').css('border','1px solid transparent');
   }
});

$('#sub').click(function(evt) {
  var n = $('#name').val();
  var em = $('#email').val();
  var pa = $('#pass').val();
  if(!validateName(n) || n.length==0 || !validateEmail(em) || em.length==0 || 
    pa.length<=6 || pa.length>=12) {
    alert("Error! Please check your details");
    evt.preventDefault();
  }
  else {
    alert("Form submitted successfully");
  }
});