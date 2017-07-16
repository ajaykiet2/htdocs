<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge">
	<div class="container">
		<span class="header-edge-title">Mock Test & Questions</span>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9">
			<?php if(!empty($questions)): ?>
			<h3 class="page-header"><span style="color:#999;"><?=$questions[0]->name;?></span></h3>
				<div class="box" id="question-container"><form id="question-form">
					<?php $counter = 0; foreach($questions as $question): $counter++;?>
					<div class=" question-box" data-id="<?=$question->id;?>" data-answer="<?=$question->answer;?>">
						<div class="">
							<h5><?=$counter;?>. <?=$question->question;?><i class="statusIcon fa-2x fa pull-right"></i></h5>
						</div>
						<div class="answer-<?=$question->id;?>">
							<span class="col-sm-12">
								<input type="radio" name="answer_<?=$question->id;?>" class="option_1" value="<?=$question->option_1;?>"> <?=$question->option_1;?>
							</span>
							<span class="col-sm-12">
								<input type="radio" name="answer_<?=$question->id;?>" class="option_2" value="<?=$question->option_2;?>"> <?=$question->option_2;?>
							</span>
							<?php if($question->option_3 != ''): ?>
							<span class="col-sm-12">
								<input type="radio" name="answer_<?=$question->id;?>" class="option_3" value="<?=$question->option_3;?>"> <?=$question->option_3;?>
							</span>
							<?php endif;?>
							<?php if($question->option_4 != ''): ?>
							<span class="col-sm-12">
								<input type="radio" name="answer_<?=$question->id;?>" class="option_4" value="<?=$question->option_4;?>"> <?=$question->option_4;?>
							</span>
							<?php endif;?>
						</div>
						<div class="clearfix"></div>
						
					</div>
					<br>
					<hr>
					<?php endforeach;?>
					</form>
				</div>
				<center><span class="btn btn-lg" id="calculatePercentage">See Result</span></center>
			<?php else: ?>
			<div class="row">
				<div class="col-sm-12 activity">
					<ul>
						<li>
							<div class="icon red">
								<i class="fa fa-warning"></i>
							</div><!-- /.icon -->
							<div class="content">
								NO QUESTION AVAILABLE
							</div><!-- /.content -->
						</li>
					</ul>
				</div>
			</div>
			<?php endif;?>
		</div>
		<div class="sidebar col-sm-4 col-md-3">
			<?php $this->load->view("website/includes/widgets/enquire");?>
			<?php $this->load->view("website/includes/widgets/contact");?>
		</div>
	</div>
</div>
<script>
$("span#calculatePercentage").click(function(){
			var correctAns = 0;
			var totalQuestions = 0;
			var percentage = 0;
			var givenAns = '';
			$("#question-container .question-box").each(function(){
				var questionID = $(this).data("id");
				var correctAnswer = $(this).data("answer");
				var $givenAnsElement = $("input[name=answer_"+questionID+"]");
				givenAns = '';
				$givenAnsElement.each(function(){
					if($(this).prop("checked")){
						givenAns = $(this).val();
					}
				});
				var $statusIcon = $(this).find("i.statusIcon");
				
				givenAns = givenAns.toString();
				correctAnswer = correctAnswer.toString();
				
				if(givenAns == correctAnswer){
					correctAns++;
					totalQuestions++;
					$statusIcon.removeClass("fa-times-circle text-danger");
					$statusIcon.addClass("fa-check-circle text-success");
					givenAns = '';
				}else{
					
					totalQuestions++;
					$statusIcon.removeClass("fa-check-circle text-success");
					$statusIcon.addClass("fa-times-circle text-danger");
				}
			});
			$.alert({
				title:"Your Result",
				content: correctAns + ' question are correct out of '+totalQuestions+'</br>'+
				'Your Percentage is: <span class="btn-warning btn-xs">'+parseFloat((correctAns*100)/totalQuestions).toFixed(2)+"</span>",
				type: 'blue'
			});
			
		});
		</script>
<?php $this->load->view('website/includes/footers/navigation');?>