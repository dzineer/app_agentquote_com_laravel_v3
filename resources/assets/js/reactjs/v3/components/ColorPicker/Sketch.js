import React, {Component} from 'react';
import PropTypes from 'prop-types';
import { SketchPicker } from 'react-color';
import reactCSS from 'reactcss';
import Label from "../Label/Label";
/** class Sketch */
class Sketch extends Component {
    constructor(props) {
        super(props);
        this.state = {
            displayColorPicker: false,
            color: {
                r: '241',
                g: '112',
                b: '19',
                a: '1',
            },
        };
    }

    componentDidMount() {
        console.log("Component Did Mount");
        // debugger;
        let newState = Object.assign({}, this.state);
        newState.color = this.props.color;
        this.setState(newState);
    }

    handleClick = () => {
        this.setState({ displayColorPicker: !this.state.displayColorPicker })
    };

    handleClose = () => {
        this.setState({ displayColorPicker: false })
    };

    handleChange = (color) => {
        this.setState({ color: color.rgb });
        this.props.onChange(this.props.name, color.rgb);
    };

    render() {

        const styles = reactCSS({
            'default': {
                color: {
                    width: '36px',
                    height: '14px',
                    borderRadius: '2px',
                    background: `rgba(${ this.props.color.r }, ${ this.props.color.g }, ${ this.props.color.b }, ${ this.props.color.a })`,
                },
                swatch: {
                    padding: '5px',
                    background: '#fff',
                    borderRadius: '1px',
                    boxShadow: '0 0 0 1px rgba(0,0,0,.1)',
                    display: 'inline-block',
                    cursor: 'pointer',
                },
                popover: {
                    position: 'absolute',
                    zIndex: '2',
                },
                cover: {
                    position: 'fixed',
                    top: '0px',
                    right: '0px',
                    bottom: '0px',
                    left: '0px',
                },
            },
        });

        return (
            <div className="form-group" style={{ margin: '20px 0'}}>
                <Label htmlFor={this.props.name} label={this.props.label} required={false} />
                <div className="field">
                    <div style={ styles.swatch } onClick={ this.handleClick }>
                        <div style={ styles.color } />
                    </div>
                    {
                        this.state.displayColorPicker ?
                            <div style={ styles.popover }>
                                <div style={ styles.cover } onClick={ this.handleClose }/>
                                <SketchPicker color={ this.props.color } onChange={ this.handleChange } />
                            </div>
                            :
                            null
                    }

                </div>
            </div>

        )
    }
}

Sketch.propTypes = {
    /** Input name. Unique HTML ID. Recommend setting this to match object's property so a single change handler can */
    name: PropTypes.string.isRequired,

    /** Input label  */
    label: PropTypes.string.isRequired,

    onChange: PropTypes.func.isRequired,

    color: PropTypes.object.isRequired
};

Sketch.defaultProps = {
    //myProp: val
};

export default Sketch;