import React, {Component} from 'react';
import PropTypes from 'prop-types';
import Message from "./Message";

/** class Messages */
class Messages extends Component {
    constructor(props) {
        super(props);
        this.state = {};
        this.messagesArr = [
            { id: "32sdfsd", full_name: "Sara Holder", email: "sholder@gmail.com", phone: "5551212", message: "lorem asdfasd asdf as dfads", date: "" }
        ];

        this.columnsArr = [
            '',
            'Full Name',
            'Email',
            'Phone',
            'Message',
            'Date'
        ];
    }

    buildMessages = () => {
      return this.props.data.map(message => {
          return <Message
                  key={message.id}
                  id={message.id}
                  full_name={message.name}
                  email={message.email}
                  phone={message.phone}
                  date={message.created_at}
                  onCheck={this.props.onCheck}
                  message={message.message} />
      });
    };

    buildColumns = () => {
      return this.columnsArr.map(column => {
          return <th key={column}>{ column }</th>
      });
    };

    render() {
        return (
            <table className="table table-striped">
                <thead>
                    <tr>
                        { this.buildColumns() }
                    </tr>
                </thead>
                <tbody>
                    { this.buildMessages() }
                </tbody>
            </table>
        );
    }
}

Messages.propTypes = {
    data: PropTypes.array.isRequired,
    onCheck: PropTypes.func.isRequired
};

Messages.defaultProps = {
    data: [],
    onCheck: () => {}
};

export default Messages;