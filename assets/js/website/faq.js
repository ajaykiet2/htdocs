$.FAQ = function(){
	
	$self = this;
	
	this.url = "/faq"
	
	
	this.send = function(inputs){
		
		var params = new FormData();
		// var csrf = $("#csrf").val();
		// params.append("csrf_ID", csrf);
		
		$.each(inputs, function(key, val){
			params.append(key,val);
		});
		
		
		$.ajax({
			url : $self.url,
			type: 'POST',
			async: true,
			processData: false,
			data: params,
			success: function(response){
				response = JSON.parse(response);				
				$self.fillQAs(response.qadata);
				$self.createPagination(response.metadata)
			},
		});
	};
	
	this.fillQAs = function(data){
		
		var qaBox = $("#faq-container .faq-item").clone();
		
		$("#faq-container .faq-item").remove();
		
		$.each(data, function(obj){
	
			var $div = qaBox.clone();
			
			$div.find(".faq-item-question h2").html(obj.question);
			$div.find(".faq-item-answer p").html(obj.answer);
			
		});
		
	};
	
	this.createPagination = function(metadata){
		
	};
	
	this.load = function(data){
		var limit = (data.limit > 0) ? data.limit : 5;
		var offset = (data.page_num - 1)*limit;
		
		var inputs = {
			action : 'loadFaq',
			limit : limit,
			offset : offset
		};
		
		$self.send(inputs);
	};
	
	this.init = function(){
		var inputs = {
			limit : 5,
			page_num : 1
		};
		$self.load(inputs);
	};
	
};

