	$("<?= $code?>").autocomplete({
		source: function (request, response) {
			$.ajax({
				url: "<?= $service ?>"+"?limit=20&name_filter="+
					request.term,
				type: "GET",
				headers: {
					"Accept": "application/json"
				}
			}).done(function (data) {
				response($.map(eval(data.suggestions), function (item) {
					return {
						label: item.name,
						value: item.code,
						region: item.region
					};
				}));
			});
		},
		select: function(event, ui) {
			$("<?= $code?>").val(ui.item.value);
			$("<?= $name?>").val(ui.item.label);
			$("<?=$remark?>").val(ui.item.region + "\n" + $("<?=$remark?>").val());
			return false;
		},
		minLength: 1
	});
