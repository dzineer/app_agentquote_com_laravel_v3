import React, {Component} from 'react';
import PropTypes from 'prop-types';
import MicrositeForm from './MicrositeForm';
import {NavLink} from "react-router-dom";
import LoadingDots from "../common/LoadingDots";

class MicrositePage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            errors: []
        };
    }

    render() {
        // // debugger;
        const { courses } = this.props;
        return (
            <div>
                <br /><br />

                <MicrositeForm errors={this.state.errors} />
            </div>
        );
    }
}

MicrositePage.propTypes = {

};

export default MicrositePage;