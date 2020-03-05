/** class FD3EventsRouter */
var FD3EventsRouter = {

    events: {},

    on( event, listener ) {
        if( ! this.state.events[ event ] ) {
            let events = Object.assign({}, this.state.events);
            events[ event ].listeners.push( listener );
            this.setState({
                events
            });
        }
    },

    off(event) {
        if( ! this.state.events[event] ) {
            let events = Object.assign({}, this.state.events);
            delete events[ event ];
            this.setState({
                events
            });
        }
    },

    emit(name, ...payload) {
        for ( const listener of this.state.events[name].listeners ) {
           listener.apply(this, payload );
        }
    }
};

export default FD3EventsRouter;