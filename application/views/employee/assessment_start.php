<h1 class="page-header"><?=strtoupper($assessment->title);?>
	<a href ="javascript:void(0)"class="pull-right important" id="countdowntimer">
		<i class="fa fa-clock-o fa-spin"></i> <span id="countDown"></span>
	</a>
</h1>

<h3 class="page-header">
	QUESTION SET: #<?=$questions[0]->questionSet;?> 
	<p class="pull-right">
	QUESTIONS: <?=$assessment->totalQuestions;?>
	</p>
</h3>
<?php if(!empty($questions)):?>
	<div class="faq" id="question-container">
	<form action="/employee/assessment/submit" id="question_form" method="post" >
		<input type="hidden" name="assessmentID" value="<?=$this->encrypt->encode($assessment->assessmentID);?>">
		<input type="hidden" name="courseID" value="<?=$this->encrypt->encode($assessment->courseID);?>">
		<input type="hidden" name="questionSet" value="<?=$questions[0]->questionSet;?>">
	<div class="box form-group question-box">
		<?php $qstnCount =1; foreach($questions as $question):?>
			<div class="faq-item-question">
				<h5><?=$qstnCount;?>. <?=$question->question;?><i class="statusIcon fa-2x fa pull-right"></i></h5>
			</div>
			<div class="faq-item-answer ">
				<span class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<input type="radio" name="answer_<?=$question->assessmentQuestionID;?>" class="option_1" value="<?=$question->option_1;?>"> <?=$question->option_1;?>
				</span>
				<span class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<input type="radio" name="answer_<?=$question->assessmentQuestionID;?>" class="option_2" value="<?=$question->option_2;?>"> <?=$question->option_2;?>
				</span>
				<?php if(!empty($question->option_3)):?>
				<span class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<input type="radio" name="answer_<?=$question->assessmentQuestionID;?>" class="option_3" value="<?=$question->option_3;?>"> <?=$question->option_3;?>
				</span>
				<?php endif;?>
				<?php if(!empty($question->option_4)):?>
				<span class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<input type="radio" name="answer_<?=$question->assessmentQuestionID;?>" class="option_4" value="<?=$question->option_4;?>"> <?=$question->option_4;?>
				</span>
				<?php endif;?>
			</div>
			<div class="clearfix"></div>
			<hr>
		<?php $qstnCount++; endforeach;?>
		</div>
		</form>
	</div>
	<center><span class="btn btn-lg" id="submitAssessment">SUBMIT</span></center>
<?php endif;?>



<script type="text/javascript" src="/assets/js/jquery.countdownTimer.min.js"></script>
<script>
$(document).ready(function(){
	
	$("#submitAssessment").click(function(){
		$("#question_form").submit();
	});
	
	function saveState(){
		var request = $("#question_form").serialize();
		$.post("/employee/assessment/submit/?"+request, function(data){});
	}
	
	//==================== Count Down Timer ==================
	$("#countDown").countdowntimer({
		minutes : <?=$assessment->duration;?>,
		size : "lg",                
		timeUp : timeIsUp,
		beforeExpiryTime : "00:00:01:05",
		beforeExpiryTimeFunction :  notifyUser
	});
	
	function timeIsUp() {
		$.alert({
			icon : "fa fa-check",
			title: "Success!",
			content: 'Your Time is up',
			type: "blue",
			buttons:{
				ok: {
					text: 'OK',
					btnClass: 'btn',
					keys: ['enter'],
					action: function(){
						saveState();
					}
				}
			}
		});
	}
	function notifyUser() {
		
	}
	
	
	window.request = '';
	window.onbeforeunload = function(e) {
	  window.request = $("#question_form").serialize();
	  return "Saving the values";
	};
	
	window.unload = function(){
		$.post("/employee/assessment/submit/?"+window.request, function(data){});
	};
	
});
</script>