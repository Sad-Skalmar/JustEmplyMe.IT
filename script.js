function show_sort_list(){
    var list = document.getElementById("sort_list");
    var show_button = document.getElementById("show_sort_list");
    var hide_button = document.getElementById("hide_sort_list");
    list.style.display = "block";
    setTimeout(function() { 
        list.style.color = "black";
    }, 50);
    show_button.style.display = "none";
    hide_button.style.display = "block";
    list.style.animation = "show_sidebar 0.3s";
}

function hide_sort_list(){
    var list = document.getElementById("sort_list");
    var show_button = document.getElementById("show_sort_list");
    var hide_button = document.getElementById("hide_sort_list");
    list.style.animation = "hide_sidebar 0.3s";
    setTimeout(function() { 
        list.style.display = "none";
        list.style.color = "#ffffff";
        hide_button.style.display = "none";
        show_button.style.display = "block";    
    }, 300);
}

function show_account_list(){
    var list = document.getElementById("account_list");
    var show_button = document.getElementById("show_account_list");
    var hide_button = document.getElementById("hide_account_list");
    list.style.display = "block";
    setTimeout(function() { 
        list.style.color = "black";
    }, 50);
    show_button.style.display = "none";
    hide_button.style.display = "block";
    list.style.animation = "show_sidebar 0.3s";
}

function hide_account_list(){
    var list = document.getElementById("account_list");
    var show_button = document.getElementById("show_account_list");
    var hide_button = document.getElementById("hide_account_list");
    list.style.animation = "hide_sidebar 0.3s";
    setTimeout(function() { 
        list.style.display = "none";
        list.style.color = "#ffffff";
        hide_button.style.display = "none";
        show_button.style.display = "block";    
    }, 300);
}
function editMainInfo(){
    isEditing = true;
    var name = document.getElementById('name');
    var status = document.getElementById('work');
    var birthDate = document.getElementById('birthDate');
    document.getElementById('editMainInfoId').style.display = "none";
    document.getElementById('saveMainChanges').style.display = "block";

    name.classList.remove('input');
    name.classList.add('inputEditable');
    name.removeAttribute('disabled');

    status.classList.remove('input');
    status.classList.add('inputEditable');
    status.removeAttribute('disabled');

    birthDate.classList.remove('input');
    birthDate.classList.add('inputEditable');
    birthDate.removeAttribute('disabled');

}

function editContactInfo(){
    isEditing = true;
    var mail = document.getElementById('mail');
    var phone = document.getElementById('phoneNumber');
    document.getElementById('editContactInfoId').style.display = "none";
    document.getElementById('saveContactChanges').style.display = "block";

    mail.classList.remove('input');
    mail.classList.add('inputEditable');
    mail.removeAttribute('disabled');

    phone.classList.remove('input');
    phone.classList.add('inputEditable');
    phone.removeAttribute('disabled');
}

function editDescriptionInfo(){
    isEditing = true;
    var description = document.getElementById('aboutMe');
    document.getElementById('editDescriptionInfoId').style.display = "none";
    document.getElementById('saveDescriptionChanges').style.display = "block";

    
    description.classList.remove('input');
    description.classList.add('inputEditable');
    description.removeAttribute('disabled');
}
var isEditing = false;
const mainInfoOver = document.getElementById('main_info');
const mainInfoButton = document.getElementById('editMainInfoId');
const contactInfoOver = document.getElementById('contact');
const contactInfoButton = document.getElementById('editContactInfoId');
const descriptionInfoOver = document.getElementById('description');
const descriptionButton = document.getElementById('editDescriptionInfoId');

    mainInfoOver.addEventListener('mouseover', () => {
if (!isEditing) {
    mainInfoButton.style.display = "block";
}
});

mainInfoOver.addEventListener('mouseout', () => {
if (!isEditing) {
    mainInfoButton.style.display = "none";
}
});

contactInfoOver.addEventListener('mouseover', () => {

    if (!isEditing) {
        contactInfoButton.style.display = "block";
    }
});


contactInfoOver.addEventListener('mouseout', () => {

    if (!isEditing) {
        contactInfoButton.style.display = "none";  
    }
});

descriptionInfoOver.addEventListener('mouseover', () => {
    if (!isEditing) {
        descriptionButton.style.display = "block";
    }
});

descriptionInfoOver.addEventListener('mouseout', () => {
    if (!isEditing) {
        descriptionButton.style.display = "none";
    }
});

