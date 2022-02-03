(function( window, undefined ){
    window.UpsellPage = {
        Initialize: function(){
            $('.upsell-item').on('click', this.UpsellItemClicked.bind(this));
        },

        UpsellItemClicked: function(event){
            let upsellItem = $(event.target).closest('.upsell-item')[0];
            let inputBox = $(upsellItem).find('input:checkbox:first')[0];
            if($(inputBox).is(":checked")){
                $(inputBox).prop("checked", false);
            } else {
                $(inputBox).prop("checked", true);
            }
        }
    };
    window.UpsellPage.Initialize();
})(window);


