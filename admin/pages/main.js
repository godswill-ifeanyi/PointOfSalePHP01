function copy() {
    var number = document.getElementById("number");

    number.select();
    number.setSelectionRange(0,99999);

    navigator.clipboard.writeText(number.value);

    alertify.set('notifier','position', 'top-right');
    alertify.success("Copied");
}










