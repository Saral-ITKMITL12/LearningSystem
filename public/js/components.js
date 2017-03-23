

var boxMenu2 = React.createClass({

  render: function() {
    return (
      React.createElement("div", null, "Hey",
      React.createElement("strong", null, this.props.name)
      )
    );
  }

});
