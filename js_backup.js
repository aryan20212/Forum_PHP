function check(){
    var btn = document.getElementById("bttt");
    var text = document.getElementById("password").value;
    var text2 = document.getElementById("cpassword").value;

    // console.log(text);
    // console.log(text2);

    if(text == text2){
        btn.classList.remove("btn-danger");
        btn.classList.remove("disabled");
        btn.classList.add("btn-primary");
        btn.innerHTML = "Signup";
        // console.log("matched");
    }
    if(text !== text2){
        btn.classList.remove("btn-success");
        btn.classList.remove("btn-primary");
        btn.classList.add("btn-danger");
        btn.classList.add("disabled");
        btn.innerHTML = "Password Not matched";
        // console.log("Not matched");
    }
    
    
}
function formcheck(){
    var text = document.getElementById("password").value;
    var text2 = document.getElementById("cpassword").value;
    if(text == text2){
        return true;
        // console.log("matched");
    }
    if(text !== text2){
        return false;
        // console.log("Not matched");
    }
}