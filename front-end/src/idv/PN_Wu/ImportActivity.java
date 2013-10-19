package idv.PN_Wu;

import java.util.Random;

import android.app.Activity;
import android.util.Log;

public class ImportActivity extends Activity {
	
	public static final int REQUEST_SCAN_BARCODE=0;
	
	private byte[][] Hash = new byte[][] {
			{ 80, 78, 32, 87, 117 },
			{ 87, 101, 108, 99, 111, 109, 101, 32, 116, 111, 32, 109, 121, 32,
					114, 111, 111, 109, 46 },
			{ 73, 39, 109, 32, 80, 78, 44, 32, 110, 105, 99, 101, 32, 116, 111,
					32, 109, 101, 101, 116, 32, 121, 111, 117, 59, 32, 72, 111,
					119, 32, 110, 105, 99, 101, 32, 116, 111, 32, 115, 101,
					101, 32, 121, 111, 117 } };

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		Log.i(new String(Hash[0]),
				new String(Hash[1 + (new Random().nextInt(Hash.length - 1))]));
	}
}
