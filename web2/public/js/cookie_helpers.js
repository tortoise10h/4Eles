function setCookie(name,value){
    document.cookie = name + "=" + value + ";path=/";
}

function getCookie(name){
    let nameEQ = name + "=";
    let cookieValues = document.cookie.split(';');
    for(let i = 0; i < cookieValues.length; i++){
        let cookieValue = cookieValues[i];
        while(cookieValue.charAt(0) == ' '){
            cookieValue = cookieValue.substring(1,cookieValue.length);
        }
        if(cookieValue.indexOf(nameEQ) == 0)
            return cookieValue.substring(nameEQ.length,cookieValue.length);
    }
    return null;
}

function eraseCookie(name){
    document.cookie = name + "=; Max-Age=-9999999";
}