import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class UserDomainLine */
class UserDomainLine extends Component {

    constructor(props) {
        super(props);
        this.state = {
            domain: null,
            fields: {
                new_group: ''
            },
            states: {
            }
        };
        this.onChange.bind(this);
    }

    componentDidMount() {
        this.setState({
            domain: this.props.domain
        });
    }

    onChange = (e) => {
        e.preventDefault();
        this.props.onChange(e.currentTarget.value);
    };

    render() {

        let styles = {
            checkbox: {
                textAlign: 'center'
            }
        };

        debugger;
        return (
            this.state.domain && <tr>
                <td style={styles.checkbox} >
                    <input type="checkbox" className="" value={ this.state.domain.id } checked={ this.props.checked } onChange={this.onChange} />
                </td>
                <td>
                    <span className="font-medium link">{ this.state.domain['user'].email }</span>
                </td>
                <td>
                    <span className="font-medium link">{this.state.domain.domain}</span>
                </td>
            </tr>
        );
    }
}

UserDomainLine.propTypes = {
    domain: PropTypes.object.isRequired,
    onChange: PropTypes.func.isRequired,
};

UserDomainLine.defaultProps = {
    domain: {},
    onChange: () => {}
};

export default UserDomainLine;
