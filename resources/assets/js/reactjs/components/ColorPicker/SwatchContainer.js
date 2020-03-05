import React, {Component} from 'react';
import PropTypes from 'prop-types';
import reactCSS from 'reactcss';
import Label from "../Label/Label";

/** class SwatchContainer */
class SwatchContainer extends Component {
    constructor(props) {
        super(props);
        this.state = {
        };
        this.basicStyle = {
            inline: {
                display: 'inline-block'
            }
        }
    }

    componentDidMount() {
        console.log("Component Did Mount");
        // debugger;
        let newState = Object.assign({}, this.state);
        newState.color = this.props.color;
        this.setState(newState);
    }

    render() {

        let styles = {
            container: {
                margin: '4px'
            }
        };

        return (
            <div style={ styles.container } >

                <div className="form-group" style={{ margin: '20px 0'}}>
                    <Label label={this.props.label} />
                    <div className="field">
                        { this.props.children }
                    </div>
                </div>
            </div>
        )
    }
}

SwatchContainer.propTypes = {
    /** Input name. Unique HTML ID. Recommend setting this to match object's property so a single change handler can */
    name: PropTypes.string.isRequired,
    label: PropTypes.string.isRequired,
    children: PropTypes.array.isRequired
};

SwatchContainer.defaultProps = {
    //myProp: val
};

export default SwatchContainer;