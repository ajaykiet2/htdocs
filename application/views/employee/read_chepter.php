<h3 class="page-header">
	CHAPTER DETAIL
	<p class="pull-right">
		<a href="/employee/course/<?=$this->encrypt->encode($chepterInfo->courseID);?>" title="Back to chepter listing"><i class="btn fa fa-long-arrow-left"></i></a>  
	</p>
</h3>
<div class="row">
	<div class="col-sm-5 col-md-4 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Title
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($chepterInfo->title);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
	<div class="col-sm-7 col-md-8 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Description
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($chepterInfo->description);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
</div>
<h3 class="page-header"><span style="color:#999;">SLIDES FOR </span> <?=strtoupper($chepterInfo->title);?></h3>
<?php if(!empty($slides)): ?>
<table class="table table-simple" id="slideShowTable">
    <thead>
        <tr>
			<th class="min-width nowrap"></th>
            <th id="slide-title"></th>
			<th class="min-width nowrap"></th>
            <th class="min-width nowrap">
				<a class="prevSlideBtn" href="javascript:void(0)" title="Previous Slide"><i class="btn btn-xs fa fa-long-arrow-left"> Prev</i></a> | 
				<a class="nextSlideBtn" href="javascript:void(0)" title="Next Slide"><i class="btn btn-xs fa fa-long-arrow-right"> Next</i></a> 
			</th>
			<th class="min-width nowrap"></th>
        </tr>
    </thead>
    <tbody>
		<tr>
			<td class="min-width nowrap"></td>
			<td class=" fr-view" id="slideShowContainer" colspan="3"></td>
			<td class="min-width nowrap"></td>
		</tr>
		
	</tbody>
</table>

<?php else: ?>
<div class="row">
	<div class="col-sm-12 activity">
		<ul>
			<li>
				<div class="icon red">
					<i class="fa fa-warning"></i>
				</div><!-- /.icon -->
				<div class="content">
					NO SLIDE AVAILABLE FOR <span style="color:#999;"><?=strtoupper($chepterInfo->title);?></span>.
				</div><!-- /.content -->
			</li>
		</ul>
	</div>
</div>
<?php endif;?>
<hr>
<h3 class="page-header"><span style="color:#999;">QUESTIONS FOR </span> <?=strtoupper($chepterInfo->title);?></h3>
<?php if(!empty($questions)): ?>
	<div class="box" id="question-container"><form id="question-form">
		<?php $counter = 0; foreach($questions as $question): $counter++;?>
		<div class=" question-box" data-id="<?=$question->chepterquestionID;?>" data-answer="<?=$question->answer;?>">
			<div class="">
				<h5><?=$counter;?>. <?=$question->question;?><i class="statusIcon fa-2x fa pull-right"></i></h5>
			</div>
			<div class="answer-<?=$question->chepterquestionID;?>">
				<span class="col-lg-3 col-md-6 col-sm-12">
					<input type="radio" name="answer_<?=$question->chepterquestionID;?>" class="option_1" value="<?=$question->option_1;?>"> <?=$question->option_1;?>
				</span>
				<span class="col-lg-3 col-md-6 col-sm-12">
					<input type="radio" name="answer_<?=$question->chepterquestionID;?>" class="option_2" value="<?=$question->option_2;?>"> <?=$question->option_2;?>
				</span>
				<?php if($question->option_3 != ''): ?>
				<span class="col-lg-3 col-md-6 col-sm-12">
					<input type="radio" name="answer_<?=$question->chepterquestionID;?>" class="option_3" value="<?=$question->option_3;?>"> <?=$question->option_3;?>
				</span>
				<?php endif;?>
				<?php if($question->option_4 != ''): ?>
				<span class="col-lg-3 col-md-6 col-sm-12">
					<input type="radio" name="answer_<?=$question->chepterquestionID;?>" class="option_4" value="<?=$question->option_4;?>"> <?=$question->option_4;?>
				</span>
				<?php endif;?>
			</div>
			<div class="clearfix"></div><br>
			<div class="pull-right">
				<span class="correct-answer"><strong>Answer:</strong> <?=$question->answer;?> &nbsp;&nbsp;&nbsp;<strong>Explanation:</strong> <?=$question->explanation;?></span>
				<span class="view-answer rate"title="View Answer"><i class="btn-secondary btn-xs fa fa-eye"></i></span>
			</div>
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
					NO QUESTION AVAILABLE FOR <span style="color:#999;"><?=strtoupper($chepterInfo->title);?></span>.
				</div><!-- /.content -->
			</li>
		</ul>
	</div>
</div>
<?php endif;?>
<script>
$.slideShow = function(){
	$self = this;
	this.totalSides = '<?=count($slides);?>';
	this.currentSlide = 0;
	this.allSlides = <?=json_encode($slides);?>;
	this.courseID = '<?=$this->encrypt->encode($chepterInfo->courseID);?>';
	
	this.fillSlide = function(index){
		$self.currentSlide = index;
		$("#slideShowContainer").html('');
		$("#slide-title").html('');
		$("#slideShowContainer").html($self.allSlides[index].content);
		$("#slide-title").html($self.allSlides[index].title);
	};
	this.start = function(){
		$.post("/employee/course/start?courseID="+$self.courseID, function(data) {});
	};	
	
	this.init = function(){
		
		$("#slideShowTable .nextSlideBtn").click(function(){
			$("#slideShowTable .prevSlideBtn").find('i').removeClass("fa-times");
			$("#slideShowTable .prevSlideBtn").find('i').addClass("fa-long-arrow-left");
			
			if($self.currentSlide < $self.totalSides - 1){
				$self.fillSlide($self.currentSlide + 1);
			}else{
				$(this).find('i').removeClass("fa-long-arrow-right");
				$(this).find('i').addClass("fa-times");
			}
		});
		
		$("#slideShowTable .prevSlideBtn").click(function(){
			
			$("#slideShowTable .nextSlideBtn").find('i').removeClass("fa-times");
			$("#slideShowTable .nextSlideBtn").find('i').addClass("fa-long-arrow-right");
			if($self.currentSlide > 0){
				$self.fillSlide($self.currentSlide - 1);
			}else{
				$(this).find('i').removeClass("fa-long-arrow-left");
				$(this).find('i').addClass("fa-times");
			}
		});
		$("span.correct-answer").hide();
		$("span.view-answer").click(function(){
			$(this).prev().toggle();
		});
		
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
		window.onunload = function() {
			$.post("/employee/course/stop?courseID="+$self.courseID, function(data) {});
		};
		$self.fillSlide(0);
	};
};

new $.slideShow().init();
</script>