import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class Timer */
class Timer extends Component {
    constructor(props) {
        super(props);

        this.state = {
            minutes: 0,
            seconds: 0,
            interval: null
        };

        this.startClock.bind(this);
        this.tick.bind(this);
        this.renderTime.bind(this);
    }

    componentDidMount() {

        this.setState({
            minutes: this.props.minutes - 1,
            seconds: 59
        });

        this.startClock();
    }

    tick = () => {
      if (this.state.minutes === 0 && this.state.seconds === 0) {

          clearInterval(this.state.interval);
          this.setState({
              interval: null,
              minutes: 0,
              seconds: 0,
              textTime: '0:00'
          });

          return this.props.callback();

      } else {
          let minutes = this.state.minutes;
          let seconds = this.state.seconds;

          // are we still counting down?
          if (seconds > 0) {
              seconds = seconds - 1;
          }

          // did we reach the end of a minute?
          if (seconds === 0) {
              if (minutes > 0) {
                  minutes = minutes - 1;
                  seconds  = 59;
              }
          }

          this.setState({
              minutes: minutes,
              seconds: seconds,
          });

      }
    };

    startClock = () => {
        let interval = setInterval( this.tick, 1000);
        this.setState({
            interval
        })
    };

    renderTime = () => {
        let textMinutes = this.state.minutes < 10 ? '0' + this.state.minutes : this.state.minutes;
        let textSeconds = this.state.seconds < 10 ? '0' + this.state.seconds : this.state.seconds;
        return textMinutes + ':' + textSeconds;
    };

    render() {
        return (
            this.state.interval && <strong id="timer-component">{ this.renderTime() }</strong>
        );
    }
}

Timer.propTypes = {
    minutes: PropTypes.number.isRequired,
    callback: PropTypes.func.isRequired
};

Timer.defaultProps = {
    minutes: 0,
    callback: () => {}
};

export default Timer;
