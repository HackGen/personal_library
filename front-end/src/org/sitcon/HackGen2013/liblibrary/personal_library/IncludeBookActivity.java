package org.sitcon.HackGen2013.liblibrary.personal_library;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;

public class IncludeBookActivity extends idv.PN_Wu.ImportActivity implements OnClickListener {

	Button button1, button2;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_include_book);
		button1 = (Button) findViewById(R.id.button1);
		button2 = (Button) findViewById(R.id.button2);
		
		button1.setOnClickListener(this);
		button2.setOnClickListener(this);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		//getMenuInflater().inflate(R.menu.include_book, menu);
		return true;
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		Intent intent;
		switch (v.getId()) {
		case R.id.button1:
			intent = new Intent(getApplicationContext(),
					IncludeBook_OnLineActivity.class);
			startActivity(intent);
			break;
		case R.id.button2:
			intent = new Intent(getApplicationContext(), IncludeBook_OffLineActivity.class);
			startActivity(intent);
			break;
		default:
			break;
		}
	}
}
