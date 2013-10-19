package org.sitcon.HackGen2013.liblibrary.personal_library;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;

public class MainActivity extends idv.PN_Wu.ImportActivity {

	static boolean non_Destroy = true;
	static boolean isStart = true;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);

		non_Destroy = true;
		isStart = true;

		new Thread() {
			public void run() {
				while (non_Destroy) {
					try {
						sleep(3000);
						if (isStart) {
							runOnUiThread(new Runnable() {
								public void run() {
									Intent intent = new Intent(
											MainActivity.this,
											IndexActivity.class);
									startActivity(intent);
									finish();
								}
							});
						} else {
							continue;
						}
					} catch (InterruptedException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					non_Destroy = false;
				}
			};
		}.start();
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		// getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}

	@Override
	protected void onDestroy() {
		// TODO Auto-generated method stub
		super.onDestroy();
		non_Destroy = false;
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		isStart = true;
	}

	@Override
	protected void onPause() {
		// TODO Auto-generated method stub
		super.onPause();
		isStart = false;
	}

}
