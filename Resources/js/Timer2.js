var hiddenValue = document.getElementById('hiddenField').value;



var testsheethis=sessionStorage.getItem("AnswersStorage").split(",");
for(let x in testsheethis)
testsheethis[x]=testsheethis[x].toUpperCase();

var c1 = 0, c2 = 0;
var answers = new Array();
let countDownDate = new Date().getTime() + 5 * 60 * 1000; 
var submission=0;

document.getElementById("submit").onclick = function (event) {
	if(submission==0){
    clearInterval(timer);
    event.preventDefault();
   
    let questions = document.querySelectorAll('.container');

    questions.forEach(function(question, index) {
        let options = question.querySelectorAll('input[type="radio"]');
        options.forEach(function(option) {
            if (option.checked) {
                answers.push(option.value);
                if(hiddenValue==="tech"){
                    if (option.value === testsheettech[index]) {
                        c2++;
                    }
                }
                else if(hiddenValue==="math"){
                    if (option.value === testsheetmath[index]) {
                        c2++;
                    }
                }
                else if(hiddenValue==="sci"){
                    if (option.value === testsheetsci[index]) {
                        c2++;
                    }
                }
                else if(hiddenValue==="gen"){
                    if (option.value === testsheetgen[index]) {
                        c2++;
                    }
                }
                else if(hiddenValue==="his"){
                    if (option.value === testsheethis[index]) {
                        c2++;
                    }
                }
            }
        });
    });

    let correctAnswers;
    if(hiddenValue==="tech"){
        c1=9;
        correctAnswers = testsheettech;
    }
    else if(hiddenValue==="math"){
        c1=9;
        correctAnswers = testsheetmath;
    }
    else if(hiddenValue==="sci"){
        c1=9;
        correctAnswers = testsheetsci;
    }
    else if(hiddenValue==="gen"){
        c1=10;
        correctAnswers = testsheetgen;
    }
    else if(hiddenValue==="his"){
        c1=10;
        correctAnswers = testsheethis;
    }

    let a = "Your score is: " + c2 + " / " + c1;
  
    let score= document.getElementById("timeleft").innerHTML=a;
    let questionContainers = document.getElementsByClassName('answers');
    for(let i=0; i<questionContainers.length; i++){
        let userAnswer = answers[i];
        let correctAnswer = correctAnswers[i];

        let result = "Your answer is: " + userAnswer + " , \n" + "The correct answer is: " + correctAnswer;
        questionContainers[i].innerHTML += '<span class="score">' + result + '</span>';
} }
submission=1;
}
function ok(event) {
    if(event) event.preventDefault();
    clearInterval(timer);
   
    let questions = document.querySelectorAll('.container');

    questions.forEach(function(question, index) {
        let options = question.querySelectorAll('input[type="radio"]');
        options.forEach(function(option) {
            if (option.checked) {
                answers.push(option.value);
                if(hiddenValue==="tech"){
                    if (option.value === testsheettech[index]) {
                        c2++;
                    }
                }
                else if(hiddenValue==="math"){
                    if (option.value === testsheetmath[index]) {
                        c2++;
                    }
                }
                else if(hiddenValue==="sci"){
                    if (option.value === testsheetsci[index]) {
                        c2++;
                    }
                }
                else if(hiddenValue==="gen"){
                    if (option.value === testsheetgen[index]) {
                        c2++;
                    }
                }
                else if(hiddenValue==="his"){
                    if (option.value === testsheethis[index]) {
                        c2++;
                    }
                }
            }
        });
    });

    let correctAnswers;
    if(hiddenValue==="tech"){
        c1=9;
        correctAnswers = testsheettech;
    }
    else if(hiddenValue==="math"){
        c1=9;
        correctAnswers = testsheetmath;
    }
    else if(hiddenValue==="sci"){
        c1=9;
        correctAnswers = testsheetsci;
    }
    else if(hiddenValue==="gen"){
        c1=10;
        correctAnswers = testsheetgen;
    }
    else if(hiddenValue==="his"){
        c1=10;
        correctAnswers = testsheethis;
    }

    let a = "Your score is: " + c2 + " / " + c1;
  
    let score= document.getElementById("timeleft").innerHTML=a; 

    let questionContainers = document.getElementsByClassName('answers');
    for(let i=0; i<questionContainers.length; i++){
        let userAnswer = answers[i];
        let correctAnswer = correctAnswers[i];

        let result = "Your answer is: " + userAnswer + " , \n" + "The correct answer is: " + correctAnswer;
        questionContainers[i].innerHTML += '<span class="score">' + result + '</span>';
    }
}
let timer = setInterval(()=> {
    let now = new Date().getTime();
    let distance = countDownDate - now;

    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

    if (distance < 0) {
        ok();
        document.getElementById("timer").innerHTML = "EXPIRED";
    }
}, 1000);