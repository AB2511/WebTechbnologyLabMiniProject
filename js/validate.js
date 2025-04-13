function validateForm() {
    let name = document.forms["regForm"]["name"].value;
    let email = document.forms["regForm"]["email"].value;
    let mobile = document.forms["regForm"]["mobile"].value;
    let password = document.forms["regForm"]["password"].value;

    if (!name || !email || !mobile || !password) {
        alert("All fields are required!");
        return false;
    }

    if (!/^[0-9]{10}$/.test(mobile)) {
        alert("Invalid mobile number.");
        return false;
    }

    return true;
}
