function convertScore(score) {
 var grade = "";
 if (score >= 0 && score < 50){
       grade = "Fail";
} else if (score >= 50 && score<60){
       grade = "Pass";
} else if (score >= 60 && score<70){
       grade = "Credit";
} else if (score >= 70 && score<80){
       grade = "Distinction";
} else if (score>= 80 && score<100){
       grade = "High Distinction";
} else {
