package com.example.rr17d2.foodtruck;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.util.Log;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {
    Intent intent;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }
    public void onClick(View view){
        switch (view.getId()){
            case R.id.SearchTruckImageView:
            case R.id.heyText:
                intent = new Intent(MainActivity.this, SearchActivity.class);
                intent.putExtra("from","search");
                startActivity(intent);
                break;
            case R.id.TruckImageView:
            case R.id.TrucktextView:
                intent = new Intent(MainActivity.this, SearchActivity.class);
                intent.putExtra("from","update");
                startActivity(intent);
                break;
        }

    }
}
