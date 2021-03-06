
var cc_activate_flags = [];
function activate_cc_m2(){
	if(crafty_cfg.enabled){
		var cfg = {
			id: "",
			core: {
				key: crafty_cfg.key,
				preformat: true,
				capsformat: {
					address: true,
					organization: true,
					county: true,
					town: true
				}
			},
			dom: {},
			sort_fields: {
				active: true,
				parent: 'div.admin__field'
			},
			search_type: crafty_cfg.searchbar_type,
			hide_fields: crafty_cfg.hide_fields,
			auto_search: crafty_cfg.auto_search,
			clean_postsearch: crafty_cfg.clean_postsearch,
			only_uk: true,
			search_wrapper: {
				before: '<div class="admin__field field"><label class="label admin__field-label">'+crafty_cfg.txt.search_label+'</label><div class="control admin__field-control">',
				after: '</div></div>'
			},
			txt: crafty_cfg.txt,
			error_msg: crafty_cfg.error_msg
		};
		var dom = {
			company:	'[name$="_address][company]"]',
			address_1:	'[name$="_address][street][0]"]',
			address_2:	'[name$="_address][street][1]"]',
			postcode:	'[name$="_address][postcode]"]',
			town:		'[name$="_address][city]"]',
			county:		'[name$="_address][region]"]',
			county_list:'[name$="_address][region_id]"]',
			country:	'select[name$="_address][country_id]"]'
		};
		var postcode_elements = jQuery(dom.postcode);
		postcode_elements.each(function(index){
			if(postcode_elements.eq(index).data('cc') != '1'){
				var active_cfg = {};
				jQuery.extend(active_cfg, cfg);
				active_cfg.id = "m2_"+cc_index;
				var form = postcode_elements.eq(index).closest('fieldset');
				console.log(form);
				cc_index++;
				active_cfg.dom = {
					company:		form.find(dom.company),
					address_1:		form.find(dom.address_1),
					address_2:		form.find(dom.address_2),
					postcode:		postcode_elements.eq(index),
					town:			form.find(dom.town),
					county:			form.find(dom.county),
					county_list:	form.find(dom.county_list),
					country:		form.find(dom.country)
				};
				active_cfg.dom.postcode.data('cc','1');
				var cc_generic = new cc_ui_handler(active_cfg);
				cc_generic.activate();
			}
		});
	}
}

var cc_index = 0;
requirejs(['jquery'], function( $ ) {
	jQuery( document ).ready(function() {
		if(crafty_cfg.enabled){
			setInterval(activate_cc_m2,200);
		}
	});
});
