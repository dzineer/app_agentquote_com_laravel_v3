import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {AddItemIcon, ColumnsIcon, CopyIcon, XIcon} from "../Icons/Icons";

/** class PageSection */
class SectionRow extends Component {

    constructor(props) {

        super(props);
        this.state = {};
        this.renderRow.bind(this);
        this.renderPanel.bind(this);
        this.renderMenu.bind(this);
        this.renderLeftBar.bind(this);
        this.renderRightPanel.bind(this);
        this.renderBottomMenu.bind(this);

        this.styles = {
            rowContainer: { "width": "100%", "position": "relative","height": "100%" },
            rowPanel: {
                "position": "absolute",
                "top": "2px",
                "left": "55px",
                "right": "0",
                "bottom": "28px",
                "borderRadius" : "5px",
                "backgroundColor" : "#ffffff",

            },
            rowPanelLeftBar: {
                "height" : "100%",
                "position": "absolute",
                "top": "0",
                "left": "0",
                "bottom": "0",
                "padding": "8px",
                "backgroundColor" : "#03c3aa",
                "borderTopLeftRadius" : "5px",
                "borderBottomLeftRadius" : "5px",
            },
            rowPanelRightContainer: {
                "position": "absolute",
                "top": "10px",
                "right": "10px",
                "bottom": "16px",
                "left": "60px",
                "padding": "10px",
            },
            sideMenuContainer: {
                "paddingLeft": "0",
                "textAlign": "center",
                "display": "flex",
                "flexDirection": "column",
                "justifyContent": "flex-start",
                "height": "100%"
            },
            bottomMenu: { "position":"absolute", "left": "56px", "bottom": "1px" },
            containers: {
                fullWidth: {
                    "position": "absolute",
                    "top": "4px",
                    "left": "0",
                    "right": "0",
                    "bottom": "0",
                    "display": "flex",
                    "flexDirection": "column",
                    "justifyContent": "center",
                    "alignItems": "center",
                    "height": "50px",
                    "border": "2px solid #4b5966",
                    "backgroundColor": "#ffffff",
                    "borderTopLeftRadius": "5px",
                    "borderBottomLeftRadius": "5px",
                    "borderTopRightRadius": "5px",
                    "borderBottomRightRadius": "5px"
                }
            }
        };
    }

    renderMenu = () => {

        return (
            <div style={ this.styles.sideMenuContainer } >
                <a className="border-0"><i className="fa fa-fw fa-edit m-y-10" style={{"color":"#383838","fontSize":"24px"}} /></a>
                <a className="border-0" style={{"cursor": "pointer"}}><CopyIcon /></a>
                <a className="border-0" style={{"cursor": "pointer"}}><ColumnsIcon /></a>
                <a className="border-0" style={{"cursor": "pointer", "marginTop":"auto"}}><XIcon /></a>
            </div>
        );
    };

    renderLeftBar = () => {
      return (
          <div className="row-panel-left-bar" style={ this.styles.rowPanelLeftBar }>
              { this.renderMenu() }
          </div>
      );
    };

    renderRightPanel = () => {
        return (
            <div className="row-panel-right-container" style={ this.styles.rowPanelRightContainer }>
                { this.getColumns() }
                {/*{ this.props.children }*/}
            </div>
        );
    };

    renderPanel = () => {
      return (
          <div className="row-panel" style={ this.styles.rowPanel }>
              { this.renderLeftBar() }
              { this.renderRightPanel() }
          </div>
      );
    };

    renderBottomMenu = () => {
      return (
          <div style={ this.styles.bottomMenu }><AddItemIcon /> Add Item</div>
      );
    };

    getColumns = () => {
        switch(this.props.columns) {
            case 1:
                return <div style={ this.styles.containers.fullWidth } > <span style={{ "color":"#383838"}}><AddItemIcon color="#383838" strokeWidth="2px" /> Insert Columns</span> </div>;
        }
    };

    renderRow = () => {

      return (
          <div style={ this.styles.rowContainer }>
              { this.renderPanel() }
              { this.renderBottomMenu }
          </div>
      );
    };

    render() {
        return (
            this.renderRow()
        );
    }
}

SectionRow.propTypes = {
   columns: PropTypes.number.isRequired
};

SectionRow.defaultProps = {
    columns: 1
};

export default SectionRow;
