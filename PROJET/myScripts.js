var message="";
function validate() {
 testEmpty();
 validateName();
 validateAge();
 validateTelephone();
 validateBirthday();
 message="";
}//end function


function testEmpty() {
 document.getElementById("errordiv").style.visibility = 'hidden';
 if ((document.getElementById("name").value ==='') ||
 (document.getElementById("age").value ==='') ||
 (document.getElementById("phone").value ==='') ||
 (document.getElementById("birthday").value ==='')) {
 alert("Un champ est vide");
 }
}//end function


function validateName() {
 if (document.getElementById("name").value === ''){
 var messageName1 = "<br/>Le champ Nom est vide.";
 message += messageName1;
 document.getElementById("errordiv").innerHTML = message;
document.getElementById("errordiv").style.visibility = 'visible';
 }//end if
}//end function


function validateAge() {
 if (document.getElementById("age").value === ''){var messageAge1 = "<br/>Le champ Age est vide.";
 message += messageAge1;
 document.getElementById("errordiv").innerHTML = message;
document.getElementById("errordiv").style.visibility = 'visible';
 }//end if
 if (document.getElementById("age").value <= 0){
 var messageAge2 = "<br/>L'age n'est peut pas être zéro ou négatif.";
 message += messageAge2;
 document.getElementById("errordiv").innerHTML = message;
document.getElementById("errordiv").style.visibility = 'visible';
 }//end if
}//end function

function validateTelephone() {
 if (document.getElementById("phone").value === ''){
 var messageTel1 = "<br/>Le champ Telephone est vide.";
 message += messageTel1;
 document.getElementById("errordiv").innerHTML = message;
document.getElementById("errordiv").style.visibility = 'visible';
 }//end if
 if ((document.getElementById("phone").value).match(/[a-z]/i)){
 var messageTel2 = "<br/>Le champ Telephone ne doit pas avoir des lettres.";
 message += messageTel2;
 document.getElementById("errordiv").innerHTML = message;
document.getElementById("errordiv").style.visibility = 'visible';
 }//end if
 if ((document.getElementById("phone").value).length != 10){
 var messageTel3 = "<br/>Le champ Telephone doit avoir 10 chiffres.";
 message += messageTel3;
 document.getElementById("errordiv").innerHTML = message;
document.getElementById("errordiv").style.visibility = 'visible';
 }//end if
}//end function


function validateBirthday() {
 if (document.getElementById("birthday").value === ''){
 var messageDate1 = "<br/>Le champ Date de naissance est vide.";
 message += messageDate1;
 document.getElementById("errordiv").innerHTML = message;
document.getElementById("errordiv").style.visibility = 'visible';
 }//end if
}//end function