import React, { Component } from 'react';
import { render } from "react-dom";
import toastr from "toastr";
import Messages from "./Messages";
import MessagesControl from "./MessagesControl";
import MessageDetail from "./MessageDetail";
import PropTypes from "prop-types";
import MessageControl from "./MessageControl";

/** function: MessagesPanel */
class MessagesPanel extends Component {
    constructor(props) {
        super(props);

        this.state = {
            message_id: 0,
            list_view: true,
            message: {},
            messages: props.messages,
            submit: false
        };

        this.userId = user_id;
        this.token = jQuery('meta[name="csrf-token"]').attr('content')

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };
    }

    onComponentDidMount() {
        this.setState({ messages: this.props.messages });
    }

    onCheck = (id, e) => {
        console.log(id);
        let setMessage = this.props.messages.filter(m => {
            return m.id === id
        })[0];

        this.setState({ message_id: e.target.checked ? id : 0 , message: setMessage });
    };

    onBack = e => {
        e.preventDefault();
        this.setState({list_view: true, message: {}, message_id: 0 });
    };

    onSearch = (search, event) => {
        // search
      console.log("[onSearch]", search);
        let fd = new FormData();
        fd.append("search" , search);
        axios.post('/user/search/messages', fd).then(res => {
            if (res.data.success) {
                this.setState({ messages: res.data.messages });
                toastr.success(res.data.message);
            } else if (res.data.failed) {
                toastr.error(res.data.message);
            } else {
                toastr.error(res.data.message);
            }
            console.log(res.data);
        }).catch(error => {
            toastr.error("An error occurred, please try again later.");
            console.log(error);
        });

    };

    onIgnore = (a, e) => {
      e.preventDefault();
    };

    onClick = (type, event) => {
        event.preventDefault();
        console.log("[type]", type,  this.state.message_id);
        if (type === "view") {
            this.setState({list_view: false});
        } else if (type === 'delete') {
            axios.delete('/user/messages/' + this.state.message_id).then(res => {
                if (res.data.success) {

                    let msgs = this.props.messages.filter(m => {
                        return m.id !== this.state.message_id
                    });

                    this.setState({
                        messages: msgs
                    });

                    toastr.success(res.data.message);
                } else if (res.data.failed) {
                    toastr.error(res.data.message);
                } else {
                    toastr.error(res.data.message);
                }
                console.log(res.data);
            }).catch(error => {
                toastr.error("An error occurred, please try again later.");
                console.log(error);
            });
        }
    };

    render() {

        let output = (
            this.state.list_view &&
            <div>
                    <MessagesControl onSearch={this.onSearch} onControlClick={
                        this.state.message_id === 0 ? this.onIgnore : this.onClick
                    }/>
                    <Messages data={this.state.messages} onCheck={this.onCheck} />
            </div>
                    ||
            <div>
                    <form>
                        <MessageControl onControlClick={this.onBack}/>
                        <MessageDetail message={this.state.message} />
                    </form>
            </div>
        );

        if (!this.state.messages.length) {
            output = (
              <h5>No Messages</h5>
            );
        }

        return (
            <div>
                { output }
            </div>
        );
    }
}

MessagesPanel.propTypes = {
    messages: PropTypes.array.isRequired
};

MessagesPanel.defaultProps = {
    messages: []
};

export default MessagesPanel;

if (document.getElementById('messages')) {
    render(<MessagesPanel messages={messages} />,
        document.getElementById('messages')
    );
}
