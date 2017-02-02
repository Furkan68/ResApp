package nl.furkancetin.resapp;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.util.SparseArray;
import android.view.SurfaceHolder;
import android.view.SurfaceView;
import android.widget.TextView;

import com.google.android.gms.vision.CameraSource;
import com.google.android.gms.vision.Detector;
import com.google.android.gms.vision.barcode.Barcode;
import com.google.android.gms.vision.barcode.BarcodeDetector;

import java.io.IOException;


public class MainActivity extends AppCompatActivity {

    private BarcodeDetector _barcodeDetector;
    private CameraSource _cameraSource;
    private SurfaceView _cameraView;
    private TextView _barcodeInfo;
    private String _QrValue;

    private boolean _detected;
    private boolean _executed;

    private boolean _falseDetected;
    private AlertDialog.Builder _builder;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        _cameraView = (SurfaceView) findViewById(R.id.camera_view);
        _barcodeInfo = (TextView) findViewById(R.id.code_info);
        _builder = new AlertDialog.Builder(this);
        _detected = false;
        _executed = false;
        _falseDetected = false;


        _barcodeDetector =
                new BarcodeDetector.Builder(this)
                        .setBarcodeFormats(Barcode.QR_CODE)
                        .build();

        _cameraSource = new CameraSource
                .Builder(this, _barcodeDetector)
                .setRequestedPreviewSize(1500, 1500)
                .build();

        _cameraView.getHolder().addCallback(new SurfaceHolder.Callback() {
            @Override
            public void surfaceCreated(SurfaceHolder holder) {
                try {
                    _cameraSource.start(_cameraView.getHolder());
                } catch (IOException ie) {
                    Log.e("CAMERA SOURCE", ie.getMessage());
                }
            }

            @Override
            public void surfaceChanged(SurfaceHolder holder, int format, int width, int height) {
            }

            @Override
            public void surfaceDestroyed(SurfaceHolder holder) {
                _cameraSource.stop();
            }
        });

        _barcodeDetector.setProcessor(new Detector.Processor<Barcode>() {
            @Override
            public void release() {
            }

            @Override
            public void receiveDetections(Detector.Detections<Barcode> detections) {
                final SparseArray<Barcode> barcodes = detections.getDetectedItems();

                if (barcodes.size() != 0) {
                    _barcodeInfo.post(new Runnable() {    // Use the post method of the TextView
                        public void run() {

                            _QrValue = barcodes.valueAt(0).displayValue;
                            if (_QrValue.indexOf("restaurant") >= 0 && _QrValue.indexOf("table") >= 0) {
                                _detected = true;
                            }else{
                                _falseDetected = true;
                            }

                            if (_detected) {
                                Log.d("string", "Contains resapp.furkancetin.nl/");

                                if (!_executed) {
                                    Intent intent = new Intent(getBaseContext(), BrowseActivity.class);
                                    intent.putExtra("QR_VALUE", _QrValue);
                                    startActivity(intent);
                                    _executed = true;
                                    finish();
                                }
                            }
                            if(_falseDetected){
                                if (!_executed) {
                                    _builder.setMessage(R.string.dialog_message)
                                            .setTitle(R.string.dialog_title);
                                    _builder.setPositiveButton(R.string.ok, new DialogInterface.OnClickListener() {
                                        public void onClick(DialogInterface dialog, int id) {
                                            _executed = false;
                                        }
                                    });
                                    AlertDialog dialog = _builder.create();
                                    dialog.show();
                                    _executed = true;
                                }
                            }
                        }
                    });

                }
            }
        });
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        _cameraSource.release();
        _barcodeDetector.release();
    }
}