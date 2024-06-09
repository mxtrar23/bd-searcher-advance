const DBS_VER = "0.0.1";

function getResults() {
	//const res = $('.bdsa-navbar-content input[type="checkbox"].categories:checked')
	const categoriesSelected = Array.from(jQuery('input[name="categories[]"]'))
	.filter(checkbox => checkbox.checked).map(selected => selected.value)
	const tagsSelected = Array.from(jQuery('input[name="tags[]"]'))
	.filter(checkbox => checkbox.checked).map(selected => selected.value)

	updatePosts({
			search:jQuery('#search_text')[0].value,
			categories:categoriesSelected,
			tags:tagsSelected,
		});
}


function updatePosts(data={search:'',categories:[],tags:[]}) {
	jQuery.ajax({
		type:'POST',
		url:dcms_vars.ajaxurl,
		data:{
			action :'dbsa_ajax_get_result',
			nonce :dcms_vars.seg,
			...data
		},
		beforeSend:()=>{console.log('beforeSend')},
		success:printPosts,
		complete:()=>{console.log('complete')},
		timeout:15000,
		error:(e)=>{console.log('error',e)}
	});
}

function printPosts (response) {
	jQuery('#bdsa-preview-response').html(response)
}

setTimeout(()=>{updatePosts()},2000)