
var quizId = document.querySelector('#quizId').value; 
var userid=document.querySelector('#userid').value;  
console.log(userid); 
var t=[];
fetch('submit_answer_user.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({quizId,userid}),
})
.then(response => response.json())
.then(data => {
    t=data.correctAnswer;
    
});


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
        c1++;
        let options = question.querySelectorAll('input[type="radio"]');
        options.forEach(function(option) {
        
            if (option.checked) {
                answers.push(option.value);
                    if (option.value === t[index]) {
                        c2++;
                    }
            }
        });
    });

    let correctAnswers=t;


    let a = "Your score is: " + c2 + " / " + c1;
  
    let scores= document.getElementById("timeleft").innerHTML=a;
    let c2Number = Number(c2);
    let c1Number = Number(c1);
    let percentageSolved = c1Number !== 0 ? (c2Number / c1Number) * 100 : 0;
    
    console.log(percentageSolved);
    let datatosend={
        quizId:quizId,
        userid:userid,
        score:c2,
        totalq:c1,
        percent:percentageSolved,
        timetaken:(5*60*1000),
        endtime:new Date().toISOString()
    };
    fetch('stat_save.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datatosend),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        } else {
            return response.text(); // Use text() to get the raw response body
        }
    })
    .then(text => {
        try {
            const data = JSON.parse(text); // Try parsing the text as JSON
            console.log('Success:', data);
        } catch (error) {
            console.error('Error parsing JSON:', error);
            console.error('Received text:', text);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
    
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
        c1++;
        let options = question.querySelectorAll('input[type="radio"]');
        options.forEach(function(option) {
           
            if (option.checked) {
                answers.push(option.value);
                    if (option.value === t[index]) {
                        c2++;
                    }
            }
        });
    });

    let correctAnswers=t;
   

    let a = "Your score is: " + c2 + " / " + c1;
  
    let scores= document.getElementById("timeleft").innerHTML=a; 
    let c2Number = Number(c2);
    let c1Number = Number(c1);
    let percentageSolved = c1Number !== 0 ? (c2Number / c1Number) * 100 : 0;
    let datatosend={
        quizId:quizId,
        userid:userid,
        score:c2,
        totalq:c1,
        percent:percentageSolved,
        timetaken:(5*60*1000),
        endtime:new Date().toISOString()
    };
    ffetch('stat_save.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datatosend),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        } else {
            return response.text(); // Use text() to get the raw response body
        }
    })
    .then(text => {
        try {
            const data = JSON.parse(text); // Try parsing the text as JSON
            console.log('Success:', data);
        } catch (error) {
            console.error('Error parsing JSON:', error);
            console.error('Received text:', text);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
    

    let questionContainers = document.getElementsByClassName('answers');
    console.log(questionContainers);
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
