
document.querySelector('form').addEventListener('submit', function(event) {
    // Prevent the form from submitting normally
    event.preventDefault();


    let quizId = document.querySelector('#quizId').value; 
    let answers = {}; 

    let radios = document.querySelectorAll('input[type=radio]');

    for (let i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
         
            answers[radios[i].name] = radios[i].value;
        }
    }

    var t="";
    fetch('submit_answer.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({quizId, answers}),
    })
    .then(response => response.json())
    .then(data => {
        t=data.score;
        console.log(t);
    });
});
