var hiddenValue = document.getElementById('hiddenField').value;

var testsheettech = ["A", "D", "A", "D", "A", "A", "D", "A", "A"];
var testsheetmath=["B","A","B","A","C","B","C","B","A"];
var testsheetgen=["B","A","C","C","D","D","D","A","A","B"];
var testsheetsci=["B","C","C","C","C","B","B","C","B"];
var testsheethis=["B","C","D","A","B","B","B","B","A","C"];
let hCheck=sessionStorage.getItem("HistoryUpdate");
let mCheck=sessionStorage.getItem("MathUpdate");
let tCheck=sessionStorage.getItem("TechUpdate");
let gkCheck=sessionStorage.getItem("GKUpdate");
let scCheck=sessionStorage.getItem("SciUpdate");
if(hCheck==1){
let History=JSON.parse(sessionStorage.getItem("UpdatedHi")); 
let answers=History.Answers;
for(let x in answers) answers[x]=answers[x].toUpperCase();
console.log("History updated length: " + answers.length);
console.log("History before length: " + testsheethis.length);
if(answers.length<testsheethis.length){
	for(let i=answers.length;i<testsheethis.length;i++){
		answers.push(testsheethis[i]);
	}
}
testsheethis=answers;

}
if(mCheck==1){
let Questions=JSON.parse(sessionStorage.getItem("UpdatedMath")); 
let answers=Questions.Answers;
for(let x in answers) answers[x]=answers[x].toUpperCase();
if(answers.length<testsheetmath.length){
	for(let i=answers.length;i<testsheetmath.length;i++){
		answers.push(testsheetmath[i]);
	}
}
testsheetmath=answers;

}
if(tCheck==1){
let Questions=JSON.parse(sessionStorage.getItem("UpdatedTech")); 
let answers=Questions.Answers;
for(let x in answers) answers[x]=answers[x].toUpperCase();
if(answers.length<testsheettech .length){
	for(let i=answers.length;i<testsheettech .length;i++){
		answers.push(testsheettech [i]);
	}
}
testsheettech =answers;

}
if(gkCheck==1){
let Questions=JSON.parse(sessionStorage.getItem("UpdatedGK")); 
let answers=Questions.Answers;
for(let x in answers) answers[x]=answers[x].toUpperCase();
if(answers.length<testsheetgen.length){
	for(let i=answers.length;i<testsheetgen.length;i++){
		answers.push(testsheetgen[i]);
	}
}
testsheetgen =answers;

}
if(scCheck==1){
let Questions=JSON.parse(sessionStorage.getItem("UpdateSci")); 
let answers=Questions.Answers;
for(let x in answers) answers[x]=answers[x].toUpperCase();
if(answers.length<testsheetsci.length){
	for(let i=answers.length;i<testsheetsci.length;i++){
		answers.push(testsheetsci[i]);
	}
}
testsheetsci=answers;

}

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