import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class NewGroupWindow */
class NewGroupWindow extends Component {
    constructor(props) {
        super(props);
        this.state = {
            new_group: '',
            show: this.props.show
        };

        this.fieldChanged.bind(this);
        this.saveGroup.bind(this);
        this.cancelGroup.bind(this);
        this.onFocus.bind(this);
    }

    saveGroup = () => {
        this.props.onChange(this.state.new_group);
        this.setState({ new_group: ''});
    };

    cancelGroup = (e) => {
        e.preventDefault();
        this.props.onCancel(e);
    };

    fieldChanged = (e) => {
        let newState = Object.assign({}, this.state);
        newState[e.target.name] = e.target.value;
        this.setState(newState );
    };

    onFocus = () => {
        if (this.props.show) {
            this.refs.new_group.focus();
        }
        return this.props.show;
    };

    render() {
        return (
           this.props.show &&
            <div className="new-group-window" ref="new_group_window">
                <div className="row">
                    <div className="col-md-12">

                        <div className="row">

                            <div className="col-md-12">
                                <div className="form-group">
                                    <label htmlFor="usr">New Group Name:</label>
                                    <input type="text" className="form-control group_name" name="new_group" onChange={this.fieldChanged} ref={input => input && input.focus()} />
                                </div>
                            </div>

                            <div className="col-md-6">
                                <input type="submit"
                                       className="btn btn-primary btn-md btn-block btn-huge control update-btn mt-3 mb-3"
                                       value=" Save " onClick={ this.saveGroup } />
                            </div>

                            <div className="col-md-6">
                                <input type="submit"
                                       className="btn btn-danger btn-md btn-block btn-huge control update-btn mt-3 mb-3"
                                       value=" Cancel " onClick={ this.cancelGroup } />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

NewGroupWindow.propTypes = {
    show: PropTypes.bool.isRequired,
    onChange: PropTypes.func.isRequired,
    onCancel: PropTypes.func.isRequired
};

NewGroupWindow.defaultProps = {
    show: false,
    onChange: () => {},
    onCancel: () => {},
};

export default NewGroupWindow;