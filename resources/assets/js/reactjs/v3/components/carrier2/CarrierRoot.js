import 'babel-polyfill';
import React, {Component} from 'react';
import { Route, BrowserRouter as Router } from 'react-router-dom';
import PropTypes from 'prop-types';
import {Provider} from 'react-redux';

/** class CarrierRoot */
class CarrierRoot extends Component {
    render() {
        return (
            <Provider store={this.props.store}>
                <Router>
                    <Route path="/" component={App} />
                </Router>
            </Provider>
        );
    }
}

CarrierRoot.propTypes = {
    store: PropTypes.object.isRequired
};

export default CarrierRoot;