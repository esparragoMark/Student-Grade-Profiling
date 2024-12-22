const toggler = document.getElementById("btn-humberger");
const sidebar = document.querySelector('.sidebar');
const links = document.querySelectorAll('.sidebar a');
const h1 = document.querySelector('.h1')

toggler.addEventListener('click', function () {
    if (sidebar.style.width === "60px") {
     
        sidebar.style.width = "260px";
        h1.style.display= 'block';
        links.forEach(link => {
            const span = link.querySelector('span');
            if (span) {
                span.style.display = "inline"; 
            }
        });
    } else {
        
        sidebar.style.width = "60px";
        h1.style.display= 'none';
        links.forEach(link => {
            const span = link.querySelector('span');
            if (span) {
                span.style.display = "none"; 
            }
        });
    }
});

  
