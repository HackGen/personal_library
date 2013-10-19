package org.sitcon.HackGen2013.liblibrary.personal_library;

import android.content.Intent;
import android.os.Bundle;
import android.text.InputFilter;
import android.text.method.DigitsKeyListener;
import android.view.Menu;
import android.widget.EditText;

public class IncludeBook_OffLineActivity extends idv.PN_Wu.ImportActivity {

	EditText editText1, editText2, editText3;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_include_book_off_line);

		Intent intent = getIntent();
		String title = intent.getStringExtra("title");
		String isbn = intent.getStringExtra("isbn");
		String author = intent.getStringExtra("author");

		editText1 = (EditText) findViewById(R.id.editText1);
		editText2 = (EditText) findViewById(R.id.editText2);
		editText3 = (EditText) findViewById(R.id.editText3);

		editText2.setFilters(new InputFilter[] { new InputFilter.AllCaps(),
				DigitsKeyListener.getInstance("1234567890-X") });

		editText1.setText(title);
		editText2.setText(isbn);
		editText3.setText(author);

	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		// getMenuInflater().inflate(R.menu.include_book_off_line, menu);
		return true;
	}

}
