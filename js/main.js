// create function to toggle burger active
const toggleBurger = (burger, nav) => {
  burger.classList.toggle('active');
  nav.classList.toggle('active');
  const body = document.body;
  body.classList.toggle('no-scroll');
}


// remove success message
const removeSuccess = () => {
  const success = document.getElementById('success');
  if (success) {
    console.log('success found')
    setTimeout(() => {
      success.remove();
     }, 3000);
  }
}

// remove message
const removeMessage = () => {
  const message = document.getElementById('message');
  if (message) {
    console.log('message found')
    setTimeout(() => {
      message.remove();
     }, 3000);
  }
}



