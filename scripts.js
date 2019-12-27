function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
    x.style.display = "block";
    } else {
    x.style.display = "none";
    }
} 
function validateComment() {
    var a = document.forms['comment-form']['firstname'].value;
    var b = document.forms['comment-form']['comment'].value;
    var element = document.getElementById("validation-message");
    if(!a || !b) {  
        element.style.display = '';
        return false;
    }
}

function togleMessage(formName) {
    let form = document.forms[formName];
    var invalid = false;

    for (let i=0; i < form.length; i++) {
        if (!form[i].value) {
            invalid = true;
            break;
        }
    }

    if (invalid) {
        return;
    }

    var element = document.getElementById("validation-message");
    element.style.display = 'none';
}

function validatePost() {
    var author = document.forms['post-form']['author'].value;
    var title = document.forms['post-form']['title'].value;
    var body = document.forms['post-form']['body'].value;

    var element = document.getElementById("validation-message");

    if (!author || !title || !body) {
        element.style.display = 'block';
        return false;
    }
}
