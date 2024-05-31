document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = document.querySelector('#name').value;
        const email = document.querySelector('#email').value;
        if (name && email) {
            alert(`Thank you, ${name}! We will contact you at ${email}.`);
        } else {
            alert('Please fill in both fields.');
        }
    });
});