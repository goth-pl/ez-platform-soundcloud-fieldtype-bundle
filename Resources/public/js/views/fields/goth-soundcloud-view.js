YUI.add('gothsoundcloud-view', function(Y) {
  'use strict';

  Y.namespace('goth');

  const FIELDTYPE_IDENTIFIER = 'goth_soundcloud';

  Y.goth.GothSoundCloudView = Y.Base.create('gothSoundCloudView', Y.eZ.FieldView, [], {

  });

  Y.eZ.FieldView.registerFieldView(
    FIELDTYPE_IDENTIFIER, Y.goth.GothSoundCloudView
  );
});