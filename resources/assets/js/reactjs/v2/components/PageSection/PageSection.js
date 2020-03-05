import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {AddItemIcon, CopyIcon, XIcon} from "../Icons/Icons";

/** class PageSection */
class PageSection extends Component {

    constructor(props) {
        super(props);
        this.state = {};
        this.renderSection.bind(this);
        this.renderPanel.bind(this);
        this.renderMenu.bind(this);
        this.renderLeftBar.bind(this);
        this.renderRightPanel.bind(this);
        this.renderBottomMenu.bind(this);

        this.styles = {
            sideMenuContainer: {
                "listStyle":"none",
                "paddingLeft": "0",
                "textAlign": "center",
                "display": "flex",
                "flexDirection": "column",
                "justifyContent": "flex-start",
                "height": "180px"
            },
            sectionContainer: {
                "marginTop": "20px",
                "width": "100%",
            },
            sectionPanel: {
                "position": "relative",
                "top": "0",
                "left": "0",
                "right": "0",
                "bottom": "0",
                "borderRadius" : "5px",
                "width" : "100%",
                "minHeight" : "200px",
                "backgroundColor" : "#dee3e7",
            },
            sectionPanelLeftBar: {
                "position": "absolute",
                "top": "0",
                "left": "0",
                "bottom": "0",
                "padding": "8px",
                "minHeight": "200px",
                "backgroundColor" : "#008bdb",
                "borderTopLeftRadius" : "5px",
                "borderBottomLeftRadius" : "5px",
            },
            sectionPanelRightContainer: {
                "position": "absolute",
                "top": "0",
                "right": "0",
                "bottom": "0",
                "padding": "10px",
                "minHeight": "208px",
                "width": "100%",
            },
            bottomMenuContainer: { "width":"100%","position": "absolute" },
            bottomMenuLinks: {"display":"inline-block","paddingLeft": "2px","paddingRight": "2px"}
        };
    }

    renderMenu = () => {

        return (
            <div style={ this.styles.sideMenuContainer } >
                <a className="border-0" style={{"cursor": "pointer"}}><i className="fa fa-fw fa-edit m-y-10" style={{"color":"#383838","fontSize":"24px"}} /></a>
                <a className="border-0" style={{"cursor": "pointer"}}><CopyIcon /></a>
                <a className="border-0" style={{"cursor": "pointer", "margin-top": "auto"}}><XIcon /></a>
            </div>
        );
    };

    renderLeftBar = () => {
      return (
          <div className="section-panel-left-bar" style={ this.styles.sectionPanelLeftBar }>
              { this.renderMenu() }
          </div>
      );
    };

    renderRightPanel = () => {
        return (
            <div className="section-panel-right-container" style={ this.styles.sectionPanelRightContainer }>
                { this.props.children }
            </div>
        );
    };

    renderPanel = () => {
      return (
          <div className="section-panel" style={ this.styles.sectionPanel }>
              { this.renderLeftBar() }
              { this.renderRightPanel() }
          </div>
      );
    };

    renderBottomMenu = () => {
      return (
          <div className="m-b-20">
              <div style={ this.styles.bottomMenuContainer }>
                  <a style={ this.styles.bottomMenuLinks }><AddItemIcon /></a>
                  <a style={ this.styles.bottomMenuLinks } >Standard Section |</a>
                  <a style={ this.styles.bottomMenuLinks } >Fullwidth Section |</a>
                  <a style={ this.styles.bottomMenuLinks } >Specialty Section |</a>
                  <a style={ this.styles.bottomMenuLinks } >Add From Library</a>
              </div>
          </div>
      );
    };

    renderSection = () => {
      return (
          <div style={ this.styles.sectionContainer }>
              { this.renderPanel() }
              { this.renderBottomMenu }
          </div>
      );
    };

    render() {
        return (
            this.renderSection()
        );
    }
}

PageSection.propTypes = {
    /*child: PropTypes.object.isRequired*/
};

PageSection.defaultProps = {
    //myProp: val
};

export default PageSection;
