
const button = document.querySelector('.start_btn');
const button2 = document.querySelector('.login_btn');
const text_wrapper = document.querySelector('.text-wrapper');
const image = document.getElementById('logo');


button.addEventListener('click', function(){
    // text_wrapper.style.display = 'none';
    image.classList.add('logo_left');
});


// dynamic words

let text1 = "Excelsior";
const textConOne = document.getElementById('text1');

let text2 = "Polytechnic";
const textConTwo = document.getElementById('text2');

let text3 = "Student";
const textConThree = document.getElementById('text3');

let text4 = "Grade Profiling";
const textConFour = document.getElementById('text4');


function dynamicWords(text, container) {
    let index = 0; 

    function animate() {
        if (index < text.length) {
            container.innerHTML += text[index];
            index++;
            setTimeout(animate, 90); 
        }
    }

    animate(); 
}


dynamicWords(text1, textConOne);
dynamicWords(text2, textConTwo);
dynamicWords(text3, textConThree);
dynamicWords(text4, textConFour);

