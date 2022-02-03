(function( window, undefined ){
    window.LandingPage = {
        _doInterrupt: false,
        Initialize: function(){
            this._doInterrupt = true;
            window.addEventListener("beforeunload", this.DoInterrupt.bind(this));
        },
        DoInterrupt: function(e){
            if(this._doInterrupt){
                /** Add code to show window here. */
                document.body.style.backgroundColor = "black";
                var confirmationMessage = "\o/";
                e.returnValue = confirmationMessage;
                return confirmationMessage;
            }

        },
        PauseDoInterrupt: function(){
            if(this._doInterrupt) {
                this._doInterrupt = false;
                setTimeout(this.ResumeDoInterrupt.bind(this), 500);
            }
        },
        ResumeDoInterrupt: function(){
            this._doInterrupt = true;
        }
    };
    //window.LandingPage.Initialize();
})(window);


