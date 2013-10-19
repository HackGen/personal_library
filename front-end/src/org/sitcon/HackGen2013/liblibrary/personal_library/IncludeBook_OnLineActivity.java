package org.sitcon.HackGen2013.liblibrary.personal_library;

import org.json.JSONException;
import org.json.JSONObject;

import android.net.Uri;
import android.os.Bundle;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.ActivityNotFoundException;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.text.InputFilter;
import android.text.method.DigitsKeyListener;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class IncludeBook_OnLineActivity extends idv.PN_Wu.ImportActivity
		implements OnClickListener {

	Button button1, button2;
	EditText editText1;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_include_book_on_line);
		button1 = (Button) findViewById(R.id.button1);
		button2 = (Button) findViewById(R.id.button2);
		editText1 = (EditText) findViewById(R.id.editText1);

		button1.setOnClickListener(this);
		button2.setOnClickListener(this);
		editText1.setFilters(new InputFilter[] { new InputFilter.AllCaps(),
				DigitsKeyListener.getInstance("1234567890-X") });
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		// getMenuInflater().inflate(R.menu.include_book, menu);
		return true;
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		Intent intent;
		switch (v.getId()) {
		case R.id.button1:
			intent = new Intent("com.google.zxing.client.android.SCAN");
			if (getPackageManager().queryIntentActivities(intent,
					PackageManager.MATCH_DEFAULT_ONLY).size() == 0) {
				AskToStartPlayStore();
			} else {
				startActivityForResult(intent, REQUEST_SCAN_BARCODE);
			}
			break;
		case R.id.button2:
			String strISBN = editText1.getText().toString().replaceAll("-", "");
			if (strISBN.length() == 10 || strISBN.length() == 13) {
				getBookInformation(strISBN);
			} else {
				Toast.makeText(getApplicationContext(), "ISBN需為10碼或13碼!",
						Toast.LENGTH_LONG).show();
				editText1.selectAll();
			}

			break;
		default:
			break;
		}
	}

	void AskToStartPlayStore() {
		AlertDialog.Builder dialog = new AlertDialog.Builder(this);
		dialog.setTitle("未安裝條碼掃描APP");
		dialog.setMessage("本程式推薦使用QuickMark Scanner, 是否立即開啟Play Store安裝?");
		dialog.setPositiveButton("取消", new DialogInterface.OnClickListener() {
			@Override
			public void onClick(DialogInterface dialog, int which) {

			}
		});
		dialog.setNegativeButton("確定", new DialogInterface.OnClickListener() {
			public void onClick(DialogInterface dialog, int which) {
				Uri uri = Uri.parse("market://search?q=QuickMark");
				Intent intent = new Intent(Intent.ACTION_VIEW, uri);
				try {
					startActivity(intent);
				} catch (ActivityNotFoundException e) {
					Toast.makeText(getApplicationContext(), "此裝置未裝有Store APP",
							Toast.LENGTH_SHORT).show();
				}
			}
		});
		dialog.show();
	}

	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		// TODO Auto-generated method stub
		super.onActivityResult(requestCode, resultCode, data);
		switch (resultCode) {
		case RESULT_OK:
			switch (requestCode) {
			case REQUEST_SCAN_BARCODE:
				String ScanResult = data.getStringExtra("SCAN_RESULT");
				String ScanResultFormat = data
						.getStringExtra("SCAN_RESULT_FORMAT");
				editText1.setText(ScanResult);
				editText1.selectAll();
				getBookInformation(ScanResult);
				break;
			default:
				break;
			}
			break;
		case RESULT_CANCELED:

			break;
		default:
			break;
		}
	}

	ProgressDialog progressDiglog;

	public void showLoading() {
		if (progressDiglog == null) {
			progressDiglog = new ProgressDialog(this);
			progressDiglog.setMessage("書籍資料搜尋中, 請稍後…");
		}
		if (progressDiglog != null && progressDiglog.isShowing()) {
			progressDiglog.dismiss();
		}
		progressDiglog.show();
	}

	void getBookInformation(final String strISBN) {
		showLoading();
		new Thread(new Runnable() {
			@Override
			public void run() {
				String strJson = idv.PN_Wu.Http.getBookInformation(strISBN);
				if (strJson != null && !strJson.equals("false")) {
					try {
						JSONObject jsonObject = new JSONObject(strJson);
						int count = jsonObject.getInt("count");
						if (count > 0) {
							final String title = jsonObject.getString("title");
							final String author = jsonObject.getString("author");
							runOnUiThread(new Runnable() {
								public void run() {
									progressDiglog.dismiss();
									Toast.makeText(
											getApplicationContext(),
											String.format(
													"title: %s\nauthor: %s",
													title, author),
											Toast.LENGTH_LONG).show();
								}
							});
						}
					} catch (JSONException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
				}
			}
		}).start();
	}
}
